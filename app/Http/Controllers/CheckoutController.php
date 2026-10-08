<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->price * $cart->quantity;
        });

        return view('user.checkout.index', compact('carts', 'total'));
    }

    public function placeOrder(Request $request)
{
    $request->validate([
        'customer_name'  => 'required|string|max:255',
        'phone'          => 'required|string|max:20',
        'address'        => 'required|string',
        'payment_method' => 'required|string',
    ]);

    $carts = Cart::where('user_id', Auth::id())->get();

    if ($carts->isEmpty()) {
        return back()->with('error', 'Your cart is empty.');
    }

    DB::beginTransaction();

    try {

        $total = $carts->sum(function ($cart) {
            return $cart->price * $cart->quantity;
        });

        // Create main order
        $order = Order::create([
            'user_id'        => Auth::id(),
            'customer_name'  => $request->customer_name,
            'customer_phone' => $request->phone,
            'address'        => $request->address,
            'payment_method' => $request->payment_method,
            'total'          => $total,
            'status'         => 'Pending',
        ]);

        // Create order items
        foreach ($carts as $cart) {

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $cart->product_id,
                'quantity'   => $cart->quantity,
                'price'      => $cart->price,
            ]);
        }

        // Clear entire cart
        Cart::where('user_id', Auth::id())->delete();

        DB::commit();

        return redirect()
            ->route('home')
            ->with('success', 'Order Placed Successfully');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', $e->getMessage());
    }
}
}