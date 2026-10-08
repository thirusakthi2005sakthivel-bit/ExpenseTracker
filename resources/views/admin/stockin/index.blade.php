@extends('admin.layout.app')

@section('title','Stock In')

@section('content')


<div class="card-soft">

    <div class="table-card-header">

    <h6>Stock In History</h6>

    <form id="filterForm" class="d-flex align-items-center gap-2">

        {{-- Supplier --}}
        <select name="supplier_id" id="supplier" class="form-select" style="width:180px;">
            <option value="">All Supplier</option>

            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}"
                    {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->supplier_name }}
                </option>
            @endforeach

        </select>

        {{-- From Date --}}
        <input type="date"
               id="from_date"
               name="from_date"
               class="form-control"
               value="{{ request('from_date') }}">

        {{-- To Date --}}
        <input type="date"
                id="to_date"
               name="to_date"
               class="form-control"
               value="{{ request('to_date') }}">

       

        {{-- Add Stock --}}
        <a href="{{ route('stockin.create') }}"
           class="btn btn-pink text-nowrap">
            <i class="bi bi-plus-lg"></i> Add Stock
        </a>

    </form>

</div>

    <div class="table-responsive">

        <table class="ims-table table">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Product</th>

                    <th>Supplier</th>

                    <th>Quantity</th>

                    <th>Buying Price</th>

                    <th>Invoice</th>

                    <th>Date</th>

                    <th>Action</th>

                </tr>

            </thead>

          <tbody id="stockTable">

@include('admin.stockin.table')

</tbody>

        </table>

    </div>

</div>
<script>

function deleteStock(id)
{
    Swal.fire({

        title:'Are you sure?',
        text:"You won't be able to revert this!",
        icon:'warning',

        showCancelButton:true,

        confirmButtonColor:'#ec1561',
        cancelButtonColor:'#6c757d',

        confirmButtonText:'Yes, Delete!'

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

function deleteStock(id)
{
    Swal.fire({
        title:'Are you sure?',
        text:"You won't be able to revert this!",
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#ec1561',
        cancelButtonColor:'#6c757d',
        confirmButtonText:'Yes, Delete!'
    }).then((result)=>{
        if(result.isConfirmed){
            document.getElementById('delete-form-'+id).submit();
        }
    });
}

$(document).ready(function(){

    function loadStock(){

        $.ajax({

            url:"{{ route('stockin.index') }}",

            type:"GET",

            data:{
                supplier_id:$('#supplier').val(),
                from_date:$('#from_date').val(),
                to_date:$('#to_date').val()
            },

            success:function(response){

                $('#stockTable').html(response);

            }

        });

    }

    $('#supplier').on('change', loadStock);
    $('#from_date').on('change', loadStock);
    $('#to_date').on('change', loadStock);

});

</script>
@endpush

@endsection