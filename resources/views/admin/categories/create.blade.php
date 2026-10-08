@extends('admin.layout.app')

@section('title', 'Add Category')

@section('content')

<nav style="font-size:13px;" class="mb-3 text-muted">
    <a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a> /
    <a href="{{ route('category.index') }}" class="text-decoration-none">Categories</a> /
    <span class="text-dark fw-semibold">Add Category</span>
</nav>

<form action="{{route('category.store')}}" method="POST">
    @csrf

    <div class="card-soft p-4">

        <h5 class="fw-bold mb-4">Category Information</h5>

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Category Name *</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Enter category name"
                       required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description"
                          rows="4"
                          class="form-control"
                          placeholder="Enter category description"></textarea>
            </div>

        </div>

    </div>

    <div class="d-flex justify-content-end gap-2 mt-3">
        <a href="{{ route('category.index') }}"
           class="btn btn-light border">
            Cancel
        </a>

        <button type="submit"
                class="btn btn-pink">
            Save Category
        </button>
    </div>

</form>

@endsection