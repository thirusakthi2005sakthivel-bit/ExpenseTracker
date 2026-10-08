@extends('admin.layout.app')

@section('title', 'Edit Supplier')

@section('content')

<nav style="font-size:13px;" class="mb-3 text-muted">
    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
    <a href="{{ route('supplier.index') }}" class="text-decoration-none">Suppliers</a> /
    <span class="text-dark fw-semibold">Edit Supplier</span>
</nav>

<form action="{{ route('supplier.update',$supplier->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card-soft p-4">

        <h5 class="fw-bold mb-4">Supplier Information</h5>

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Supplier Name</label>
                <input type="text"
                       name="supplier_name"
                       class="form-control"
                       value="{{ $supplier->supplier_name }}"
                       required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Contact Person</label>
                <input type="text"
                       name="contact_person"
                       class="form-control"
                       value="{{ $supplier->contact_person }}"
                       required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text"
                       name="phone"
                       class="form-control"
                       value="{{ $supplier->phone }}"
                       required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ $supplier->email }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Status</label>

                <select name="status" class="form-select">

                    <option value="active"
                        {{ $supplier->status=='active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ $supplier->status=='inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>

            <div class="col-12">
                <label class="form-label">Address</label>

                <textarea
                    name="address"
                    rows="4"
                    class="form-control">{{ $supplier->address }}</textarea>

            </div>

        </div>

    </div>

    <div class="d-flex justify-content-end gap-2 mt-3">

        <a href="{{ route('supplier.index') }}"
           class="btn btn-light border">
            Cancel
        </a>

        <button type="submit"
                class="btn btn-pink">
            Update Supplier
        </button>

    </div>

</form>

@endsection