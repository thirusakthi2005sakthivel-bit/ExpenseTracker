@extends('admin.layout.app')

@section('title', 'Products')

@section('content')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif
<style>
#suggestions{
    max-height:250px;
    overflow-y:auto;
    background:#fff;
    border-radius:8px;
    box-shadow:0 4px 12px rgba(0,0,0,.12);
}

#suggestions .list-group-item{
    cursor:pointer;
}
</style>

<div class="card-soft">
    <div class="table-card-header">
        <h6>All Products</h6>
        <div class="d-flex align-items-center gap-2">
           <div class="position-relative">

    <input type="text"
           id="search"
           class="form-control form-control-sm"
           placeholder="Search Product Name..."
           autocomplete="off">

    <div id="suggestions"
         class="list-group position-absolute w-100"
         style="z-index:9999;display:none;">
    </div>

</div>
            <a href="{{route('product.create')}}" class="btn btn-pink btn-sm"><i class="bi bi-plus-lg"></i> Add
                Product</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="ims-table table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Stock</th>
                    <th>Selling Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $product->productname }}</td>

                    <td>{{ $product->category->name }}</td>

                    <td>{{ $product->supplier->supplier_name }}</td>

                    <td>
                        @if($product->stock <= 5) <span class="badge bg-warning text-dark">
                            {{ $product->stock }}
                            </span>
                            @else
                            {{ $product->stock }}
                            @endif
                    </td>

                    <td>₹{{ number_format($product->selling_price, 2) }}</td>

                    <td>
                        @if($product->status == 'active')
                        <span class="badge-status badge-active">
                            Active
                        </span>
                        @else
                        <span class="badge bg-secondary">
                            Inactive
                        </span>
                        @endif
                    </td>

                    <td>
                        <a href="{{route('product.edit', $product->id)}}" class="action-btn action-edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>

                        <form id="delete-form-{{ $product->id }}" action="{{ route('product.delete', $product->id) }}"
                            method="POST" class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="button" class="action-btn action-delete border-0 bg-transparent"
                                onclick="deleteProduct({{ $product->id }})">
                                <i class="bi bi-trash-fill"></i>
                            </button>

                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        No Products Found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
</div>
<script>
    function deleteProduct(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ec1561',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }

        });
    }
</script>
@push('scripts')
<script>
$(document).ready(function () {

    $('#search').on('keyup', function () {

        let search = $(this).val();

        // TABLE FILTER
        $('tbody tr').each(function () {

            let productName = $(this)
                .find('td:eq(1)')
                .text()
                .toLowerCase();

            if(productName.indexOf(search.toLowerCase()) > -1)
            {
                $(this).show();
            }
            else
            {
                $(this).hide();
            }

        });

        // AJAX SUGGESTION
        if(search.length > 0)
        {
            $.ajax({
                url: "{{ route('product.search') }}",
                type: "GET",
                data: {
                    search: search
                },
                success: function(response)
                {
                    let html = '';

                    response.forEach(function(product){

                        html += `
                            <a href="#"
                               class="list-group-item list-group-item-action suggestion-item">
                                ${product.productname}
                            </a>
                        `;

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
    $(document).on('click', '.suggestion-item', function(e){

        e.preventDefault();

        let productName = $(this).text().trim();

        $('#search').val(productName);

        $('#suggestions').hide();

        $('tbody tr').each(function(){

            let rowText = $(this)
                .find('td:eq(1)')
                .text()
                .toLowerCase();

            if(rowText.indexOf(productName.toLowerCase()) > -1)
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