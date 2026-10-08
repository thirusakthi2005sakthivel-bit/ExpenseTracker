@extends('admin.layout.app')

@section('title', 'Add Product')

@section('content')

<nav style="font-size:13px;" class="mb-3 text-muted">
    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
    <a href="{{ route('product.index') }}" class="text-decoration-none">Products</a> /
    <span class="text-dark fw-semibold">Add Product</span>
</nav>

<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card-soft p-4 h-100">
                <h6 class="fw-bold mb-3">Product Information</h6>
                <div class="mb-3">
                    <label class="form-label">Product Name *</label>
                    <input type="text" name="productname" class="form-control" placeholder="Enter product name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Category *</label>
                    <select name="category_id" class="form-select">
                        <option value="">Select the Category</option>

                            @foreach($categories as $category)

                            <option value="{{ $category->id }}">

                            {{ $category->name }}

                            </option>

                            @endforeach

                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Supplier *</label>
                       <select name="supplier_id" class="form-select" placeholder="select the supplier">
                        <option value="">Select the Supplier</option>

                            @foreach($suppliers as $supplier)

                            <option value="{{ $supplier->id }}">

                            {{ $supplier->supplier_name }}

                            </option>

                            @endforeach

                            </select>
                </div>
                <div class="mb-3">
    <label class="form-label">Product Image</label>
    <input type="file" name="product_image" class="form-control" accept="image/*">
    <small class="text-muted">Upload JPG, PNG or JPEG image</small>
</div>
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-soft p-4 h-100">
                <h6 class="fw-bold mb-3">Product Details</h6>
                <div class="mb-3">
                    <label class="form-label">Purchase Price *</label>
                    <input type="number" step="0.01" name="purchase_price" class="form-control" placeholder="Enter purchase price" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Selling Price *</label>
                    <input type="number" step="0.01" name="selling_price" class="form-control" placeholder="Enter selling price" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Initial Stock *</label>
                    <input type="number" name="stock" class="form-control" placeholder="Enter initial stock" required>
                </div>
                <div class="mb-0">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-3">
        <button type="reset" class="btn btn-light border">Reset</button>
        <button type="submit" class="btn btn-pink">Save Product</button>
    </div>
</form>

@endsection