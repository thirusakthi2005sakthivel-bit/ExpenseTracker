<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Cart Page
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->price * $cart->quantity;
        });

        return view('user.cart.index', compact('carts', 'total'));
    }

    // Add To Cart
   public function store(Request $request)
{
    $product = Product::findOrFail($request->product_id);

    $cart = Cart::where('user_id', Auth::id())
        ->where('product_id', $product->id)
        ->first();

    if ($cart) {

        $cart->increment('quantity');

    } else {

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->selling_price,
        ]);
    }

    $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');

    return response()->json([
        'success' => true,
        'cartCount' => $cartCount
    ]);
}

    // Update Quantity (AJAX)
    public function update(Request $request, Cart $cart)
    {
        $cart->update([
            'quantity' => $request->quantity
        ]);

        $total = Cart::where('user_id', Auth::id())
            ->get()
            ->sum(function ($item) {
                return $item->price * $item->quantity;
            });

        return response()->json([
            'success'   => true,
            'quantity'  => $cart->quantity,
            'subtotal'  => $cart->price * $cart->quantity,
            'grandTotal'=> $total
        ]);
    }

    // Remove Item (AJAX)
    public function destroy(Cart $cart)
{
    $cart->delete();

    // Grand Total
    $grandTotal = Cart::where('user_id', Auth::id())
        ->get()
        ->sum(function ($item) {
            return $item->price * $item->quantity;
        });

    // Cart Count
    $cartCount = Cart::where('user_id', Auth::id())
        ->sum('quantity');

    return response()->json([
        'success'    => true,
        'grandTotal' => $grandTotal,
        'cartCount'  => $cartCount
    ]);
}
}