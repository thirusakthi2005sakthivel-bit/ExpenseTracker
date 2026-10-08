@extends('admin.layout.app')

@section('title','Reports')

@section('content')

<div class="card-soft">

    <div class="table-card-header">

        <h6>Inventory Reports</h6>

        <form action="{{ route('reports.index') }}"
              method="GET"
              class="d-flex align-items-center gap-2 flex-wrap">

            {{-- Search --}}
            <input type="text"
                   id="search"
                   name="search"
                   class="form-control"
                   placeholder="Search Product"
                   style="width:180px;"
                   value="{{ request('search') }}">

            {{-- Category --}}
            <select id="category"
                    name="category_id"
                    class="form-select"
                    style="width:170px;">

                <option value="">All Categories</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>

            {{-- Supplier --}}
            <select id="supplier"
                    name="supplier_id"
                    class="form-select"
                    style="width:170px;">

                <option value="">All Suppliers</option>

                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}"
                        {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->supplier_name }}
                    </option>
                @endforeach

            </select>

            {{-- Status --}}
            <select id="status"
                    name="status"
                    class="form-select"
                    style="width:150px;">

                         <option value="">Stock Status</option>

                            <option value="instock"
                            {{ request('status')=='instock' ? 'selected' : '' }}>
                            In Stock
                            </option>

                            <option value="lowstock"
                            {{ request('status')=='lowstock' ? 'selected' : '' }}>
                            Low Stock
                            </option>

                            <option value="outstock"
                            {{ request('status')=='outstock' ? 'selected' : '' }}>
                            Out Of Stock
                            </option>

            </select>

            {{-- From Date --}}
            <input type="date"
                   id="from_date"
                   name="from_date"
                   class="form-control"
                   style="width:150px;"
                   value="{{ request('from_date') }}">

            {{-- To Date --}}
            <input type="date"
                   id="to_date"
                   name="to_date"
                   class="form-control"
                   style="width:150px;"
                   value="{{ request('to_date') }}">

            {{-- Search --}}
            <button class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>

            {{-- Reset --}}
            <a href="{{ route('reports.index') }}"
               class="btn btn-secondary">
                <i class="bi bi-arrow-clockwise"></i>
            </a>

        </form>

       <a href="{{ route('reports.export', request()->query()) }}"
   class="btn btn-success">
    Export Excel
</a>

    </div>

    <div class="table-responsive">

        <table class="table ims-table">

          <thead>

<tr>

    <th>#</th>

    <th>Product</th>

    <th>Category</th>

    <th>Supplier</th>

    <th>Stock In Date</th>

    <th>Invoice No</th>

    <th>Current Stock</th>

    <th>Buying Price</th>

    <th>Selling Price</th>

    <th>Status</th>

</tr>

</thead>

            <tbody id="reportTable">

                @include('admin.reports.table')

            </tbody>

        </table>

    </div>

</div>

@endsection


@push('scripts')

<script>

function loadReports(){

    $.ajax({

        url:"{{ route('reports.index') }}",

        type:"GET",

        data:{
            search:$('#search').val(),
            category_id:$('#category').val(),
            supplier_id:$('#supplier').val(),
            status:$('#status').val(),
            from_date:$('#from_date').val(),
            to_date:$('#to_date').val()
        },

            success:function(response){

    $('#reportTable').html(response);

    const params = new URLSearchParams({
        search: $('#search').val(),
        category_id: $('#category').val(),
        supplier_id: $('#supplier').val(),
        status: $('#status').val(),
        from_date: $('#from_date').val(),
        to_date: $('#to_date').val()
    });

    $('.btn-success').attr(
        'href',
        "{{ route('reports.export') }}?" + params.toString()
    );

}

    });

}

$('#search').keyup(loadReports);
$('#category').change(loadReports);
$('#supplier').change(loadReports);
$('#status').change(loadReports);
$('#from_date').change(loadReports);
$('#to_date').change(loadReports);

</script>

@endpush