<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
     public function index()
    {
        $suppliers = Supplier::latest()->get();

        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
{
    return view('admin.suppliers.create');
}
    public function store(Request $request)
{
    $request->validate([
        'supplier_name'  => 'required',
        'contact_person' => 'required',
        'phone'          => 'required',
        'email'          => 'nullable|email',
        'address'        => 'nullable',
        'status'         => 'required'
    ]);

    Supplier::create([
        'supplier_name'  => $request->supplier_name,
        'contact_person' => $request->contact_person,
        'phone'          => $request->phone,
        'email'          => $request->email,
        'address'        => $request->address,
        'status'         => $request->status
    ]);

    return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier Added Successfully');
}


      public function edit($id)
{
    $supplier = Supplier::findOrFail($id);

    return view('admin.suppliers.edit', compact('supplier'));
}    
    public function update(Request $request, $id)
{
    $supplier = Supplier::findOrFail($id);

    $request->validate([
        'supplier_name'  => 'required',
        'contact_person' => 'required',
        'phone'          => 'required',
        'email'          => 'nullable|email',
        'address'        => 'nullable',
        'status'         => 'required'
    ]);

    $supplier->update([
        'supplier_name'  => $request->supplier_name,
        'contact_person' => $request->contact_person,
        'phone'          => $request->phone,
        'email'          => $request->email,
        'address'        => $request->address,
        'status'         => $request->status,
    ]);

    return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier Updated Successfully');
}


        public function destroy($id)
{
    $supplier = Supplier::findOrFail($id);

    $supplier->delete();

    return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier Deleted Successfully');
}

        public function search(Request $request)
{
    $suppliers = Supplier::where('supplier_name', 'LIKE', '%' . $request->search . '%')
                    ->limit(5)
                    ->get();

    return response()->json($suppliers);
}
    
}
