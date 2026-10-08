@forelse($stockouts as $stockout)

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>{{ $stockout->product->productname ?? '-' }}</td>

    <td>
        @if($stockout->reason == 'Sold')
            <span class="badge bg-success">Sold</span>
        @elseif($stockout->reason == 'Damaged')
            <span class="badge bg-danger">Damaged</span>
        @else
            <span class="badge bg-warning text-dark">Expired</span>
        @endif
    </td>

    <td>{{ $stockout->quantity }}</td>

    <td>{{ \Carbon\Carbon::parse($stockout->stock_out_date)->format('d-m-Y') }}</td>

    <td>

      
        <form id="delete-form-{{ $stockout->id }}"
              action="{{ route('stockout.destroy', $stockout->id) }}"
              method="POST"
              style="display:inline;">

            @csrf
            @method('DELETE')

            <button type="button"
                    class="action-btn action-delete"
                    onclick="deleteStockOut({{ $stockout->id }})">

                <i class="bi bi-trash-fill"></i>

            </button>

        </form>

    </td>

</tr>

@empty

<tr>

    <td colspan="6" class="text-center">
        No Stock Out Records Found
    </td>

</tr>

@endforelse