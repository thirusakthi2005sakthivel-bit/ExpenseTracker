@extends('admin.layout.app')

@section('title','Add Stock Out')

@section('content')

<div class="content">

<div class="card-soft p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="fw-bold">
            <i class="bi bi-box-arrow-up text-danger"></i>
            Add Stock Out
        </h4>

        <a href="{{ route('stockout.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Back

        </a>

    </div>

<form action="{{ route('stockout.store') }}"
      method="POST">

@csrf

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Product

</label>

<select name="product_id"
        id="product"
        class="form-select"
        required>

<option value="">Select Product</option>

@foreach($products as $product)

<option value="{{ $product->id }}"
        data-stock="{{ $product->stock }}">

{{ $product->productname }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Available Stock

</label>

<input type="text"
       id="stock"
       class="form-control"
       readonly>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Quantity

</label>

<input type="number"
       name="quantity"
       min="1"
       class="form-control"
       required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Reason

</label>

<select name="reason"
        class="form-select"
        required>

<option value="">Choose</option>

<option value="Sold">Sold</option>

<option value="Damaged">Damaged</option>

<option value="Expired">Expired</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Date

</label>

<input type="date"
       name="stock_out_date"
       class="form-control"
       value="{{ date('Y-m-d') }}"
       required>

</div>

</div>

<div class="text-end">

<button class="btn btn-pink">

<i class="bi bi-check-circle-fill"></i>

Save Stock Out

</button>

</div>

</form>

</div>

</div>

<script>

document.getElementById('product').addEventListener('change',function(){

let stock=this.options[this.selectedIndex].dataset.stock;

document.getElementById('stock').value=stock;

});

</script>

@endsection