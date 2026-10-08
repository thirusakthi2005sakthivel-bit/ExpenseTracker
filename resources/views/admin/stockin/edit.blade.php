@extends('admin.layout.app')

@section('title','Edit Stock In')

@section('content')

<nav style="font-size:13px;" class="mb-3 text-muted">
    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
    <a href="{{ route('stockin.index') }}" class="text-decoration-none">Stock In</a> /
    <span class="text-dark fw-semibold">Edit Stock</span>
</nav>

<form action="{{ route('stockin.update', $stockin->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card-soft p-4">

        <h5 class="fw-bold mb-4">Edit Stock In Details</h5>

        <div class="row g-3">

            <!-- Product -->
            <div class="col-md-6">
                <label class="form-label">Product</label>
                <select name="product_id" id="product_select" class="form-select" required>
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            {{ $stockin->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->productname }}
                        </option>
                    @endforeach
                </select>
            </div>

           

            <!-- Supplier -->
            <div class="col-md-6">
                <label class="form-label">Supplier</label>
                <select name="supplier_id" class="form-select" required>
                    <option value="">-- Select Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ $stockin->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->supplier_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Quantity -->
            <div class="col-md-6">
                <label class="form-label">Quantity</label>
                <input type="number"
                       name="quantity"
                       class="form-control"
                       value="{{ old('quantity', $stockin->quantity) }}"
                       required>
            </div>

            <!-- Buying Price -->
            <div class="col-md-6">
                <label class="form-label">Buying Price</label>
                <input type="number"
                       step="0.01"
                       name="buying_price"
                       class="form-control"
                       value="{{ old('buying_price', $stockin->buying_price) }}"
                       required>
            </div>

            <!-- Invoice No -->
            <div class="col-md-6">
                <label class="form-label">Invoice No</label>
                <input type="text"
                       name="invoice_no"
                       class="form-control"
                       value="{{ old('invoice_no', $stockin->invoice_no) }}">
            </div>

            <!-- Date -->
            <div class="col-md-6">
                <label class="form-label">Stock In Date</label>
                <input type="date"
                       name="stock_in_date"
                       class="form-control"
                       value="{{ old('stock_in_date', $stockin->stock_in_date) }}"
                       required>
            </div>

            <!-- Remarks -->
            <div class="col-md-6">
                <label class="form-label">Remarks</label>
                <textarea name="remarks"
                          class="form-control"
                          rows="2">{{ old('remarks', $stockin->remarks) }}</textarea>
            </div>

        </div>

    </div>

    <div class="d-flex justify-content-end gap-2 mt-3">
        <a href="{{ route('stockin.index') }}" class="btn btn-light border">Cancel</a>
        <button type="submit" class="btn btn-pink">Update Stock</button>
    </div>

</form>

@endsection

