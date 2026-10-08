<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StockOutA;
use App\Services\WhatsAppService;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('product')
            ->when($request->search, function ($query) use ($request) {
                $query->where('customer_name', 'like', '%' . $request->search . '%')
                    ->orWhereHas('product', function ($q) use ($request) {
                        $q->where('productname', 'like', '%' . $request->search . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'      => 'required|exists:products,id',
            'customer_name'   => 'required|string|max:255',
            'customer_phone'  => 'required|string|max:20',
            'customer_email'  => 'nullable|email|max:255',
            'quantity'        => 'required|integer|min:1',
            'address'         => 'required|string',
            'note'            => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with(
                'error',
                'Only ' . $product->stock . ' item(s) available in stock.'
            );
        }

        $price = $product->selling_price;
        $total = $price * $request->quantity;

        $order = Order::create([
            'product_id'      => $product->id,
            'customer_name'   => $request->customer_name,
            'customer_phone'  => $request->customer_phone,
            'customer_email'  => $request->customer_email,
            'quantity'        => $request->quantity,
            'price'           => $price,
            'total'           => $total,
            'address'         => $request->address,
            'note'            => $request->note,
            'status'          => 'Pending',
        ]);

        try {
            $whatsapp = new WhatsAppService();

            $message = "🛒 *NEW ORDER RECEIVED*\n\n";
            $message .= "👤 Customer : {$order->customer_name}\n";
            $message .= "📱 Phone : {$order->customer_phone}\n";
            $message .= "📦 Product : {$product->productname}\n";
            $message .= "🔢 Qty : {$order->quantity}\n";
            $message .= "💰 Total : ₹{$order->total}\n";
            $message .= "📌 Status : Pending";

            $whatsapp->send(
                env('ADMIN_WHATSAPP'),
                $message
            );
        } catch (\Exception $e) {
            // Ignore WhatsApp errors
        }

        return back()->with(
            'success',
            '🎉 Order Placed Successfully!'
        );
    }

   public function accept(Order $order)
{
    if ($order->status != 'Pending') {
        return back()->with(
            'error',
            'Order already processed.'
        );
    }

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | OLD DIRECT ORDER
        |--------------------------------------------------------------------------
        */

        if ($order->product_id) {

            $product = Product::findOrFail($order->product_id);

            if ($product->stock < $order->quantity) {
                return back()->with(
                    'error',
                    'Insufficient Stock.'
                );
            }

            // Reduce stock
            $product->decrement(
                'stock',
                $order->quantity
            );

            // Stock out
            StockOutA::create([
                'product_id'     => $order->product_id,
                'quantity'       => $order->quantity,
                'reason'         => 'Sold',
                'stock_out_date' => now()->toDateString(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CART CHECKOUT ORDER
        |--------------------------------------------------------------------------
        */

        else {

            $items = $order->items()->with('product')->get();

            if ($items->isEmpty()) {
                return back()->with(
                    'error',
                    'No products found in this order.'
                );
            }

            // First check stock for ALL products
            foreach ($items as $item) {

                $product = $item->product;

                if (!$product) {
                    return back()->with(
                        'error',
                        'Product not found.'
                    );
                }

                if ($product->stock < $item->quantity) {
                    return back()->with(
                        'error',
                        'Insufficient stock for ' . $product->productname
                    );
                }
            }

            // Reduce stock + create stock out
            foreach ($items as $item) {

                $product = $item->product;

                $product->decrement(
                    'stock',
                    $item->quantity
                );

                StockOutA::create([
                    'product_id'     => $item->product_id,
                    'quantity'       => $item->quantity,
                    'reason'         => 'Sold',
                    'stock_out_date' => now()->toDateString(),
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE ORDER STATUS
        |--------------------------------------------------------------------------
        */

        $order->update([
            'status' => 'Accepted'
        ]);

        /*
        |--------------------------------------------------------------------------
        | WHATSAPP
        |--------------------------------------------------------------------------
        */

        $customerNumber = preg_replace(
            '/\D/',
            '',
            $order->customer_phone
        );

        if (substr($customerNumber, 0, 2) != '91') {
            $customerNumber = '91' . $customerNumber;
        }

        try {

            $whatsapp = new WhatsAppService();

            $message = "✅ *ORDER ACCEPTED*\n\n";
            $message .= "Hello {$order->customer_name} 👋\n\n";

            if ($order->product_id) {

                $message .= "📦 Product : {$product->productname}\n";
                $message .= "🔢 Quantity : {$order->quantity}\n";

            } else {

                $items = $order->items()->with('product')->get();

                $message .= "📦 *Products:*\n";

                foreach ($items as $item) {
                    $message .= "• {$item->product->productname} × {$item->quantity}\n";
                }
            }

            $message .= "\n💰 Total : ₹{$order->total}\n\n";
            $message .= "🙏 Thank you for shopping with *Madhu Fancy Store* ❤️";

            $whatsapp->send(
                $customerNumber,
                $message
            );

        } catch (\Exception $e) {
            // Ignore WhatsApp errors
        }

        DB::commit();

        return back()->with(
            'success',
            'Order Accepted Successfully.'
        );

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with(
            'error',
            $e->getMessage()
        );
    }
}
}