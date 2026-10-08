@extends('admin.layout.app')

@section('title', 'Add Supplier')

@section('content')

<nav style="font-size:13px;" class="mb-3 text-muted">
    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
    <a href="{{ route('supplier.index') }}" class="text-decoration-none">Suppliers</a> /
    <span class="text-dark fw-semibold">Add Supplier</span>
</nav>

<form action="{{ route('supplier.store') }}" method="POST">
    @csrf

    <div class="card-soft p-4">

        <h5 class="fw-bold mb-4">
            Supplier Information
        </h5>

        <div class="row g-3">

            <!-- Supplier Name -->
            <div class="col-md-6">
                <label class="form-label">Supplier Name <span class="text-danger">*</span></label>
                <input type="text"
                       name="supplier_name"
                       class="form-control"
                       placeholder="Enter supplier name"
                       required>
            </div>

            <!-- Contact Person -->
            <div class="col-md-6">
                <label class="form-label">Contact Person <span class="text-danger">*</span></label>
                <input type="text"
                       name="contact_person"
                       class="form-control"
                       placeholder="Enter contact person"
                       required>
            </div>

            <!-- Phone -->
            <div class="col-md-6">
                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                <input type="text"
                       name="phone"
                       class="form-control"
                       placeholder="Enter phone number"
                       required>
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Enter email">
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <!-- Address -->
            <div class="col-12">
                <label class="form-label">Address</label>
                <textarea name="address"
                          rows="4"
                          class="form-control"
                          placeholder="Enter supplier address"></textarea>
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
            Save Supplier
        </button>

    </div>

</form>

@endsection