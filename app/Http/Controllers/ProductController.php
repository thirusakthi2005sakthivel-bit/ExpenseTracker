<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductController extends Controller
{
   

public function index(Request $request)
{
    $products = Product::when($request->search, function ($query) use ($request) {
        $query->where('productname', 'like', '%' . $request->search . '%');
    })
    ->latest()
    ->paginate(15);

    return view('admin.products.index', compact('products'));
}

public function search(Request $request)
{
    $products = Product::where('productname', 'LIKE', '%' . $request->search . '%')
                ->select('id', 'productname')
                ->limit(10)
                ->get();

    return response()->json($products);
}

  public function create()
{
    $categories = Category::where('status','active')->get();
    $suppliers = Supplier::where('status','active')->get();

    return view('admin.products.create', compact('categories','suppliers'));
}
    public function store(Request $request)
{
    $data = $request->validate([
        'productname'     => 'required',
        'category_id'    => 'required|exists:categories,id',
        'supplier_id'    => 'required|exists:suppliers,id',
        'purchase_price'  => 'required',
        'selling_price'   => 'required',
        'stock'           => 'required',
        'status'          => 'required',
        'product_image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('product_image')) {

        $data['product_image'] = $request->file('product_image')
                                        ->store('products', 'public');
    }

    Product::create($data);

    return redirect()
        ->route('product.index')
        ->with('success', 'Product Added Successfully');
}

public function edit($id)
{
   $product = Product::findOrFail($id);

$categories = Category::where('status','active')->get();

$suppliers = Supplier::where('status','active')->get();

return view('admin.products.edit',
compact('product','categories','suppliers'));
}


public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $data = $request->validate([
        'productname'    => 'required',
        'category_id'    => 'required|exists:categories,id',
        'supplier_id'    => 'required|exists:suppliers,id',
        'purchase_price' => 'required',
        'selling_price'  => 'required',
        'stock'          => 'required',
        'status'         => 'required',
        'product_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('product_image')) {

        if ($product->product_image) {
            Storage::disk('public')->delete($product->product_image);
        }

        $data['product_image'] = $request->file('product_image')
                                        ->store('products', 'public');
    }

    $product->update($data);

    return redirect()
        ->route('product.index')
        ->with('success', 'Product Updated Successfully');
}



public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Image delete
    if ($product->product_image) {
        Storage::disk('public')->delete($product->product_image);
    }

    // Product delete
    $product->delete();

    return redirect()
            ->route('product.index')
            ->with('success', 'Product Deleted Successfully');
}

    
}
