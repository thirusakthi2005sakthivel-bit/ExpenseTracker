@extends('admin.layout.app')

@section('title', 'Edit Product')

@section('content')

<nav style="font-size:13px;" class="mb-3 text-muted">
    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
    <a href="{{ route('product.index') }}" class="text-decoration-none">Products</a> /
    <span class="text-dark fw-semibold">Edit Product</span>
</nav>

<form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')


<div class="row g-3">

    <div class="col-lg-6">
        <div class="card-soft p-4 h-100">

            <h6 class="fw-bold mb-3">Product Information</h6>

            <div class="mb-3">
                <label class="form-label">Product Name *</label>
                <input type="text"
                       name="productname"
                       class="form-control"
                       value="{{ old('productname', $product->productname) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category *</label>
                        <select name="category_id" class="form-select" required>
    <option value="">Select category</option>

    @foreach($categories as $category)
        <option value="{{ $category->id }}"
            {{ $product->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>
            </div>

            <div class="mb-3">
                <label class="form-label">Supplier *</label>
                       <select name="supplier_id" class="form-select" required>
    <option value="">Select supplier</option>

    @foreach($suppliers as $supplier)
        <option value="{{ $supplier->id }}"
            {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
            {{ $supplier->supplier_name }}
        </option>
    @endforeach
</select>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file"
                       name="product_image"
                       class="form-control"
                       accept="image/*">
                <small class="text-muted">
                    Leave empty if you don't want to change the image
                </small>
            </div>

        </div>
    </div>

    <div class="col-lg-6">
        <div class="card-soft p-4 h-100">

            <h6 class="fw-bold mb-3">Product Details</h6>

            <div class="mb-3">
                <label class="form-label">Purchase Price *</label>
                <input type="number"
                       step="0.01"
                       name="purchase_price"
                       class="form-control"
                       value="{{ old('purchase_price', $product->purchase_price) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Selling Price *</label>
                <input type="number"
                       step="0.01"
                       name="selling_price"
                       class="form-control"
                       value="{{ old('selling_price', $product->selling_price) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock *</label>
                <input type="number"
                       name="stock"
                       class="form-control"
                       value="{{ old('stock', $product->stock) }}"
                       required>
            </div>

            <div class="mb-0">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

        </div>
    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-3">
    <a href="{{ route('product.index') }}" class="btn btn-light border">
        Cancel
    </a>

    <button type="submit" class="btn btn-pink">
        Update Product
    </button>
</div>
```

</form>

@endsection
