@forelse($products as $product)

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>{{ $product->productname }}</td>

    <td>{{ $product->category->name ?? '-' }}</td>

    <td>{{ $product->supplier->supplier_name ?? '-' }}</td>

    <td>{{ $product->stock }}</td>

    <td>₹{{ number_format($product->purchase_price,2) }}</td>

    <td>₹{{ number_format($product->selling_price,2) }}</td>

    <td>

        @if($product->stock == 0)

            <span class="badge bg-danger">
                Out Of Stock
            </span>

        @elseif($product->stock <= 5)

            <span class="badge bg-warning text-dark">
                Low Stock
            </span>

        @else

            <span class="badge bg-success">
                In Stock
            </span>

        @endif

    </td>

</tr>

@empty

<tr>

    <td colspan="8" class="text-center">

        No Inventory Records Found

    </td>

</tr>

@endforelse