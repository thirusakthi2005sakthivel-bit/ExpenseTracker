<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
 public function index(Request $request)
{
    $categories = Category::where('name', 'like', '%' . $request->search . '%')
                    ->latest()
                    ->get();

    return view('admin.categories.index', compact('categories'));
}

    public function create(){
        return view('admin.categories.create');
    }
    

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'nullable',
        'status' => 'required'
    ]);

    Category::create([
        'name' => $request->name,
        'description' => $request->description,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('category.index')
        ->with('success','Category Added Successfully');
}

public function edit($id)
{
    $category = Category::findOrFail($id);

    return view('admin.categories.edit', compact('category'));
}
public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'description' => 'nullable',
        'status' => 'required'
    ]);

    $category->update([
        'name' => $request->name,
        'description' => $request->description,
        'status' => $request->status
    ]);

    return redirect()
            ->route('category.index')
            ->with('success', 'Category Updated Successfully');
}
public function destroy($id)
{
    $category = Category::findOrFail($id);

    $category->delete();

    return redirect()
            ->route('category.index')
            ->with('success', 'Category Deleted Successfully');
}

public function search(Request $request)
{
    $categories = Category::where('name', 'LIKE', '%' . $request->search . '%')
                    ->limit(5)
                    ->get();

    return response()->json($categories);
}
}
