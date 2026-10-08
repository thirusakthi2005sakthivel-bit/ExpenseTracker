@extends('admin.layout.app')

@section('title','Inventory Monitor')

@section('content')

<div class="content">

    {{-- Summary Cards --}}
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card-soft text-center p-3">
                <h6>Total Products</h6>
                <h3>{{ $totalProducts }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-soft text-center p-3">
                <h6>In Stock</h6>
                <h3 class="text-success">{{ $inStock }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-soft text-center p-3">
                <h6>Low Stock</h6>
                <h3 class="text-warning">{{ $lowStock }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-soft text-center p-3">
                <h6>Out of Stock</h6>
                <h3 class="text-danger">{{ $outStock }}</h3>
            </div>
        </div>

    </div>

    <div class="card-soft">

        <div class="table-card-header">

            <h6>Inventory Monitor</h6>

            <form id="filterForm"
                  class="d-flex align-items-center gap-2 flex-wrap">

                {{-- Search --}}
                <input type="text"
                       id="search"
                       class="form-control"
                       placeholder="Search Product"
                       style="width:220px;">

                {{-- Category --}}
                <select id="category"
                        class="form-select"
                        style="width:180px;">

                    <option value="">All Category</option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

                {{-- Status --}}
                <select id="status"
                        class="form-select"
                        style="width:180px;">

                    <option value="">All Status</option>
                    <option value="instock">In Stock</option>
                    <option value="lowstock">Low Stock</option>
                    <option value="outstock">Out Of Stock</option>

                </select>

                <a href="{{ route('inventory.index') }}"
                   class="btn btn-secondary">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

            </form>

        </div>

        <div class="table-responsive">

            <table class="table ims-table">

                <thead>

                <tr>

                    <th>#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Stock</th>
                    <th>Buying</th>
                    <th>Selling</th>
                    <th>Status</th>

                </tr>

                </thead>

                <tbody id="inventoryTable">

                    @include('admin.inventory.table')

                </tbody>

            </table>

        </div>

    </div>

</div>
@push('scripts')
<script>

$(function(){

    function loadInventory(){

        $.get("{{ route('inventory.index') }}",{

            search:$('#search').val(),

            category_id:$('#category').val(),

            status:$('#status').val()

        },function(data){

            $('#inventoryTable').html(data);

        });

    }

    $('#search').keyup(loadInventory);

    $('#category').change(loadInventory);

    $('#status').change(loadInventory);

});

</script>
@endpush

@endsection