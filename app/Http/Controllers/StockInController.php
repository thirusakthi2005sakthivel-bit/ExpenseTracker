<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockIn;
use App\Models\Product;
use App\Models\Supplier;

class StockInController extends Controller
{
    // Index
    public function index(Request $request)
{
    $query = StockIn::with(['product','supplier']);

    if ($request->filled('supplier_id')) {
        $query->where('supplier_id', $request->supplier_id);
    }

    if ($request->filled('from_date')) {
        $query->whereDate('stock_in_date','>=',$request->from_date);
    }

    if ($request->filled('to_date')) {
        $query->whereDate('stock_in_date','<=',$request->to_date);
    }

    $stockins = $query->latest()->get();

    if($request->ajax()){
        return view('admin.stockin.table', compact('stockins'))->render();
    }

    $suppliers = Supplier::where('status','active')->get();

    return view('admin.stockin.index',compact('stockins','suppliers'));
}
    

    // Create
    public function create()
    {
        $products = Product::where('status','active')->get();

        $suppliers = Supplier::where('status','active')->get();

        return view('admin.stockin.create', compact('products','suppliers'));
    }

    public function getProductDetails($id)
{
    $product = Product::with('supplier', 'category')->findOrFail($id);
    
    return response()->json([
        'category'    => $product->category->categoryname ?? '-',
        'supplier'    => $product->supplier->supplier_name ?? '-',
        'stock'       => $product->stock,
        'selling_price' => $product->selling_price,
    ]);
}

    // Store 
    public function store(Request $request)
{
      $request->validate([
    'product_id'    => 'required|exists:products,id',
    'supplier_id'   => 'required|exists:suppliers,id',
    'quantity'      => 'required|integer|min:1',
    'buying_price'  => 'required|numeric|min:0',
    'invoice_no'    => 'nullable|string|max:100',
    'stock_in_date' => 'required|date',
    'remarks'       => 'nullable|string'
]);

    StockIn::create([

        'product_id'=>$request->product_id,

        'supplier_id'=>$request->supplier_id,

        'quantity'=>$request->quantity,

        'buying_price'=>$request->buying_price,

        'invoice_no'=>$request->invoice_no,

        'stock_in_date'=>$request->stock_in_date,

        'remarks'=>$request->remarks

    ]);

    // Increase Product Stock

    $product = Product::findOrFail($request->product_id);

    $product->stock += $request->quantity;

    $product->save();

    return redirect()
            ->route('stockin.index')
            ->with('success','Stock Added Successfully');
}

    // Edit
public function edit($id)
{
    $stockin = StockIn::findOrFail($id);
    $products = Product::where('status','active')->get();
    $suppliers = Supplier::where('status','active')->get();
    
    return view('admin.stockin.edit', compact('stockin','products','suppliers'));
}

// Update
public function update(Request $request, $id)
{
    $request->validate([
        'product_id'    => 'required|exists:products,id',
        'supplier_id'   => 'required|exists:suppliers,id',
        'quantity'      => 'required|integer|min:1',
        'buying_price'  => 'required|numeric|min:0',
        'invoice_no'    => 'nullable|string|max:100',
        'stock_in_date' => 'required|date',
        'remarks'       => 'nullable|string'
    ]);

    $stockin = StockIn::findOrFail($id);

    
    $oldProduct = Product::findOrFail($stockin->product_id);
    $oldProduct->stock -= $stockin->quantity;
    $oldProduct->save();

  
    $stockin->update([
        'product_id'    => $request->product_id,
        'supplier_id'   => $request->supplier_id,
        'quantity'      => $request->quantity,
        'buying_price'  => $request->buying_price,
        'invoice_no'    => $request->invoice_no,
        'stock_in_date' => $request->stock_in_date,
        'remarks'       => $request->remarks,
    ]);

   
    $newProduct = Product::findOrFail($request->product_id);
    $newProduct->stock += $request->quantity;
    $newProduct->save();

    return redirect()
            ->route('stockin.index')
            ->with('success','Stock Updated Successfully');
}

// Delete
public function destroy($id)
{
    $stockin = StockIn::findOrFail($id);

    
    $product = Product::findOrFail($stockin->product_id);
    $product->stock -= $stockin->quantity;
    $product->save();

    $stockin->delete();

    return redirect()
            ->route('stockin.index')
            ->with('success','Stock Deleted Successfully');
}

}