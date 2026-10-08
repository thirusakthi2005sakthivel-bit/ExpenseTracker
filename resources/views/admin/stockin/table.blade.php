  

                @forelse($stockins as $stock)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $stock->product->productname }}</td>

                    <td>{{ $stock->supplier->supplier_name }}</td>

                    <td>{{ $stock->quantity }}</td>

                    <td>₹{{ number_format($stock->buying_price,2) }}</td>

                    <td>{{ $stock->invoice_no }}</td>

                    <td>{{ $stock->stock_in_date }}</td>

                    <td>

                        <a href="{{ route('stockin.edit',$stock->id) }}"
                        class="action-btn action-edit">

                            <i class="bi bi-pencil-fill"></i>

                        </a>

                        <form id="delete-form-{{ $stock->id }}" action="{{ route('stockin.delete', $stock->id) }}"
                            method="POST" class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="button" class="action-btn action-delete border-0 bg-transparent"
                                onclick="deleteStock({{ $stock->id }})">
                                <i class="bi bi-trash-fill"></i>
                            </button>

                        </form>
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" class="text-center">

                        No Stock Records Found

                    </td>

                </tr>

                @endforelse

            