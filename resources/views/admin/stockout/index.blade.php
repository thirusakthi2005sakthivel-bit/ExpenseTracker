@extends('admin.layout.app')

@section('title','Stock Out')

@section('content')

<div class="card-soft">

    <div class="table-card-header">

        <h6>Stock Out History</h6>

        <form id="filterForm" class="d-flex align-items-center gap-2">

            {{-- Product --}}
            <select name="product_id"
                    id="product"
                    class="form-select"
                    style="width:220px;">

                <option value="">All Products</option>

                @foreach($products as $product)

                    <option value="{{ $product->id }}"
                        {{ request('product_id') == $product->id ? 'selected' : '' }}>

                        {{ $product->productname }}

                    </option>

                @endforeach

            </select>

            {{-- From --}}
            <input type="date"
                   id="from_date"
                   name="from_date"
                   value="{{ request('from_date') }}"
                   class="form-control">

            {{-- To --}}
            <input type="date"
                   id="to_date"
                   name="to_date"
                   value="{{ request('to_date') }}"
                   class="form-control">

     

            

            <a href="{{ route('stockout.create') }}"
               class="btn btn-pink text-nowrap">

                <i class="bi bi-plus-lg"></i>

                Add Stock Out

            </a>

        </form>

    </div>

    <div class="table-responsive">

        <table class="table ims-table">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Product</th>

                    <th>Reason</th>

                    <th>Quantity</th>

                    <th>Date</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tbody id="stockOutTable">

                @include('admin.stockout.table')

            </tbody>

        </table>

    </div>

</div>

<script>

function deleteStockOut(id)
{
    Swal.fire({

        title:'Delete Stock Out?',

        text:'This action cannot be undone.',

        icon:'warning',

        showCancelButton:true,

        confirmButtonColor:'#ec1561',

        cancelButtonColor:'#6c757d',

        confirmButtonText:'Delete'

    }).then((result)=>{

        if(result.isConfirmed)
        {
            document.getElementById('delete-form-'+id).submit();
        }

    });
}

</script>
@push('scripts')
<script>

$(function () {

    function loadStockOut() {

        
        $.get("{{ route('stockout.index') }}", {
            product_id: $('#product').val(),
            from_date: $('#from_date').val(),
            to_date: $('#to_date').val()
        }, function (data) {

            $('#stockOutTable').html(data);

        });

    }

    $('#product').change(function () {
        loadStockOut();
    });

    $('#from_date').change(function () {
        loadStockOut();
    });

    $('#to_date').change(function () {
        loadStockOut();
    });

}); 

</script>
@endpush

@endsection