@extends('admin.layout.app')

@section('title', 'Suppliers')

@section('content')

<style>
#suggestions{
    max-height:250px;
    overflow-y:auto;
    background:#fff;
    border-radius:8px;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}
</style>

<div class="card-soft">

    <div class="table-card-header">

        <h6>All Suppliers</h6>

        <div class="d-flex align-items-center gap-2">

            <div class="position-relative">

    <input type="text"
           id="search"
           class="form-control form-control-sm"
           placeholder="Search Supplier..."
           autocomplete="off">

    <div id="suggestions"
         class="list-group position-absolute w-100"
         style="display:none;z-index:9999;">
    </div>

</div>

            <a href="{{ route('supplier.create') }}"
               class="btn btn-pink btn-sm">

                <i class="bi bi-plus-lg"></i>
                Add Supplier

            </a>

        </div>

    </div>

    <div class="table-responsive">

        <table class="ims-table table">

            <thead>

            <tr>
                <th>#</th>
                <th>Supplier Name</th>
                <th>Contact Person</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            </thead>

            <tbody>

            @forelse($suppliers as $supplier)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $supplier->supplier_name }}</td>

                <td>{{ $supplier->contact_person }}</td>

                <td>{{ $supplier->phone }}</td>

                <td>{{ $supplier->email }}</td>

                <td>

                    @if($supplier->status=='active')

                        <span class="badge-status badge-active">
                            Active
                        </span>

                    @else

                        <span class="badge-status badge-inactive">
                            Inactive
                        </span>

                    @endif

                </td>

                <td>

                    <a href="{{ route('supplier.edit',$supplier->id) }}"
                       class="action-btn action-edit">

                        <i class="bi bi-pencil-fill"></i>

                    </a>

                    <form
                        action="{{ route('supplier.delete',$supplier->id) }}"
                        method="POST"
                        class="d-inline"
                        id="delete-form-{{ $supplier->id }}">

                        @csrf
                        @method('DELETE')

                        <button
                            type="button"
                            class="action-btn action-delete border-0 bg-transparent"
                            onclick="deleteSupplier({{ $supplier->id }})">

                            <i class="bi bi-trash-fill"></i>

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" class="text-center">

                    No Suppliers Found

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>



<script>

function deleteSupplier(id)
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
$(document).ready(function () {

    $('#search').on('keyup', function () {

        let search = $(this).val();

        // Table Filter
        $('tbody tr').each(function () {

            let supplierName = $(this)
                .find('td:eq(1)')
                .text()
                .toLowerCase();

            if (supplierName.indexOf(search.toLowerCase()) > -1)
            {
                $(this).show();
            }
            else
            {
                $(this).hide();
            }

        });

        // AJAX Suggestion
        if(search.length > 0)
        {
            $.ajax({

                url: "{{ route('supplier.search') }}",

                type: "GET",

                data:{
                    search: search
                },

                success:function(response)
                {
                    let html='';

                    response.forEach(function(supplier){

                        html += `
                        <a href="#"
                           class="list-group-item list-group-item-action suggestion-item">

                           ${supplier.supplier_name}

                        </a>`;
                    });

                    $('#suggestions').html(html).show();

                }

            });
        }
        else
        {
            $('#suggestions').hide();
        }

    });

    // Suggestion Click
    $(document).on('click','.suggestion-item',function(e){

        e.preventDefault();

        let supplierName=$(this).text().trim();

        $('#search').val(supplierName);

        $('#suggestions').hide();

        $('tbody tr').each(function(){

            let rowText=$(this)
                .find('td:eq(1)')
                .text()
                .toLowerCase();

            if(rowText.indexOf(supplierName.toLowerCase())>-1)
            {
                $(this).show();
            }
            else
            {
                $(this).hide();
            }

        });

    });

    // Outside Click
    $(document).click(function(e){

        if(!$(e.target).closest('#search,#suggestions').length)
        {
            $('#suggestions').hide();
        }

    });

});
</script>

@endpush


@endsection