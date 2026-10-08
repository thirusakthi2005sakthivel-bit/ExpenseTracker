@extends('admin.layout.app')

@section('title', 'Categories')

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
        <h6>All Categories</h6>
        <div class="d-flex align-items-center gap-2">
            <div class="position-relative">

  <input type="text"
       id="search"
       name="search"
       class="form-control form-control-sm"
       placeholder="Search Category..."
       autocomplete="off">

    <div id="suggestions"
         class="list-group position-absolute w-100"
         style="z-index:9999;display:none;">
    </div>

</div>
            <a href="{{route('category.create')}}" class="btn btn-pink btn-sm"><i class="bi bi-plus-lg"></i> Add
                Category</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="ims-table table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>{{ $category->name }}</td>

    <td>{{ $category->description }}</td>

    <td>
        @if($category->status == 'active')
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
        <a href="{{route('category.edit',$category->id)}}" class="action-btn action-edit">
            <i class="bi bi-pencil-fill"></i>
        </a>

        <form id="delete-form-{{ $category->id }}" action="{{ route('category.delete', $category->id) }}"
                            method="POST" class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="button" class="action-btn action-delete border-0 bg-transparent"
                                onclick="deleteProduct({{ $category->id }})">
                                <i class="bi bi-trash-fill"></i>
                            </button>

                        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center">
        No Categories Found
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

            let categoryName = $(this)
                .find('td:eq(1)')
                .text()
                .toLowerCase();

            if(categoryName.indexOf(search.toLowerCase()) > -1)
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
                url: "{{ route('category.search') }}",
                type: "GET",
                data: {
                    search: search
                },
                success: function(response)
                {
                    let html = '';

                    response.forEach(function(category){

                        html += `
                            <a href="#"
                               class="list-group-item list-group-item-action suggestion-item">
                                ${category.name}
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

        let categoryName = $(this).text().trim();

        $('#search').val(categoryName);

        $('#suggestions').hide();

        $('tbody tr').each(function(){

            let rowText = $(this)
                .find('td:eq(1)')
                .text()
                .toLowerCase();

            if(rowText.indexOf(categoryName.toLowerCase()) > -1)
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