@extends('admin.layout.app')

@section('title','Add Stock In')

@section('content')

<nav style="font-size:13px;" class="mb-3 text-muted">
    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
    <a href="{{ route('stockin.index') }}" class="text-decoration-none">Stock In</a> /
    <span class="text-dark fw-semibold">Add Stock</span>
</nav>

<form action="{{ route('stockin.store') }}" method="POST">
    @csrf

    <div class="card-soft p-4">

        <h5 class="fw-bold mb-4">Stock In Details</h5>

        <div class="row g-3">

            <!-- Product -->
            <div class="col-md-6">
                <label class="form-label">Product</label>
                <select  id="product_id" name="product_id" class="form-select" required>
                    <option value="">-- Select Product --</option>

                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
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
                        <option value="{{ $supplier->id }}">
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
                       value="{{ old('quantity') }}"
                       required>
            </div>

            <!-- Buying Price -->
            <div class="col-md-6">
                <label class="form-label">Buying Price</label>
                <input type="number"
                       step="0.01"
                       name="buying_price"
                       class="form-control"
                       value="{{ old('buying_price') }}"
                       required>
            </div>

            <!-- Invoice No -->
            <div class="col-md-6">
                <label class="form-label">Invoice No</label>
                <input type="text"
                       name="invoice_no"
                       class="form-control"
                       value="{{ old('invoice_no') }}">
            </div>

            <!-- Date -->
            <div class="col-md-6">
                <label class="form-label">Stock In Date</label>
                <input type="date"
                       name="stock_in_date"
                       class="form-control"
                       value="{{ old('stock_in_date') }}"
                       required>
            </div>

        </div>

    </div>

    <div class="d-flex justify-content-end gap-2 mt-3">

        <a href="{{ route('stockin.index') }}"
           class="btn btn-light border">
            Cancel
        </a>

        <button type="submit"
                class="btn btn-pink">
            Save Stock
        </button>

    </div>

</form>

@push('scripts')
<script>
    document.getElementById('product_select').addEventListener('change', function() {
        const productId = this.value;
        
        if (!productId) {
            document.getElementById('product-details').style.display = 'none';
            return;
        }

        fetch(`/product/details/${productId}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('detail-category').textContent = data.category;
                document.getElementById('detail-supplier').textContent = data.supplier;
                document.getElementById('detail-stock').textContent = data.stock + ' units';
                document.getElementById('detail-price').textContent = parseFloat(data.selling_price).toFixed(2);
                document.getElementById('product-details').style.display = 'block';
            })
            .catch(err => console.error('Error:', err));
    });
</script>
@endpush
@endsection