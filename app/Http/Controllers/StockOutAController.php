<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOutA;
use Illuminate\Http\Request;

class StockOutAController extends Controller
{
    // ==========================
    // INDEX
    // ==========================
public function index(Request $request)
{
    $products = Product::where('status','active')->get();

    $stockouts = StockOutA::with('product')

        ->when($request->product_id, function ($query) use ($request) {
            $query->where('product_id', $request->product_id);
        })

        ->when($request->from_date, function ($query) use ($request) {
            $query->whereDate('stock_out_date', '>=', $request->from_date);
        })

        ->when($request->to_date, function ($query) use ($request) {
            $query->whereDate('stock_out_date', '<=', $request->to_date);
        })

        ->latest()
        ->paginate(10);

    if ($request->ajax()) {
        return view('admin.stockout.table', compact('stockouts'))->render();
    }

    return view('admin.stockout.index', compact('products','stockouts'));
}




    public function create()
{
    $products = Product::where('status','active')->get();

    return view('admin.stockout.create', compact('products'));
}
    // ==========================
    // STORE
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'product_id'     => 'required|exists:products,id',
            'quantity'       => 'required|integer|min:1',
            'reason'         => 'required|string|max:255',
            'stock_out_date' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {

            return back()->with(
                'error',
                'Only '.$product->stock.' item(s) available.'
            );
        }

        StockOutA::create([
            'product_id'     => $request->product_id,
            'quantity'       => $request->quantity,
            'reason'         => $request->reason,
            'stock_out_date' => $request->stock_out_date,
        ]);

        // Reduce Stock
        $product->decrement('stock', $request->quantity);

        return back()->with('success', 'Stock Out Added Successfully.');
    }

 

    // ==========================
    // UPDATE
    // ==========================
    public function update(Request $request, StockOutA $stockOutA)
    {
        $request->validate([
            'quantity'       => 'required|integer|min:1',
            'reason'         => 'required|string|max:255',
            'stock_out_date' => 'required|date',
        ]);

        $product = Product::findOrFail($stockOutA->product_id);

        // Restore old stock
        $product->increment('stock', $stockOutA->quantity);

        if ($product->stock < $request->quantity) {

            // Undo restore
            $product->decrement('stock', $stockOutA->quantity);

            return back()->with('error', 'Insufficient Stock.');
        }

        // Reduce new quantity
        $product->decrement('stock', $request->quantity);

        $stockOutA->update([
            'quantity'       => $request->quantity,
            'reason'         => $request->reason,
            'stock_out_date' => $request->stock_out_date,
        ]);

        return back()->with('success', 'Stock Out Updated Successfully.');
    }

    // ==========================
    // DELETE
    // ==========================
    public function destroy(StockOutA $stockOutA)
    {
        $product = Product::findOrFail($stockOutA->product_id);

        // Restore Stock
        $product->increment('stock', $stockOutA->quantity);

        $stockOutA->delete();

        return back()->with('success', 'Stock Out Deleted Successfully.');
    }
}