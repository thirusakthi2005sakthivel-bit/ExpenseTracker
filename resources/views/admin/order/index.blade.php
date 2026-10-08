@extends('admin.layout.app')
@section('title','Order')

@section('content')


<div class="content">

    <div class="card-soft">

        <div class="table-card-header">

            <h6>Orders</h6>

            <form method="GET" class="d-flex">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control me-2"
                       placeholder="Search Customer or Product">

                <button class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>

            </form>

        </div>

        <div class="table-responsive">

            <table class="table ims-table">

                <thead>

                <tr>

                    <th>#</th>

                    <th>Customer</th>

                    <th>Phone</th>

                    <th>Product</th>

                    <th>Qty</th>

                    <th>Total</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($orders as $order)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $order->customer_name }}</td>

                    <td>{{ $order->customer_phone }}</td>

                     <td>
    @if($order->product)
        {{ $order->product->productname }}
    @elseif($order->items->count())
        @foreach($order->items as $item)
            {{ $item->product->productname ?? 'Product Deleted' }}
            @if(!$loop->last), @endif
        @endforeach
    @else
        -
    @endif
</td>

<td>
    @if($order->product)
        {{ $order->quantity }}
    @elseif($order->items->count())
        @foreach($order->items as $item)
            {{ $item->quantity }}
            @if(!$loop->last), @endif
        @endforeach
    @else
        -
    @endif
</td>
                    <td>₹{{ number_format($order->total,2) }}</td>

                    <td>

                        @if($order->status == 'Pending')

                            <span class="badge bg-warning">Pending</span>

                        @elseif($order->status == 'Accepted')

                            <span class="badge bg-success">Accepted</span>

                        @elseif($order->status == 'Delivered')

                            <span class="badge bg-primary">Delivered</span>

                        @else

                            <span class="badge bg-danger">Cancelled</span>

                        @endif

                    </td>

                    <td>

<button
    class="action-btn action-view viewOrderBtn"

    data-id="{{ $order->id }}"
    data-customer="{{ $order->customer_name }}"
    data-phone="{{ $order->customer_phone }}"
    data-email="{{ $order->customer_email }}"
   data-product="{{
    $order->product
        ? $order->product->productname
        : $order->items->map(function($item) {
            return ($item->product->productname ?? 'Product Deleted') . ' × ' . $item->quantity;
        })->implode(', ')
}}"
data-qty="{{
    $order->product
        ? $order->quantity
        : $order->items->sum('quantity')
}}"

data-price="{{
    $order->product
        ? $order->price
        : '-'
}}"
    data-total="{{ $order->total }}"
    data-address="{{ $order->address }}"
    data-note="{{ $order->note }}"
    data-status="{{ $order->status }}"

    data-bs-toggle="modal"
    data-bs-target="#viewOrderModal">

    <i class="bi bi-eye-fill"></i>

</button>

</td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" class="text-center">

                        No Orders Found

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="p-3">

            {{ $orders->links() }}

        </div>

    </div>

</div>


<div class="modal fade" id="viewOrderModal">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Order Details
                </h5>

                <button class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <table class="table">

                    <tr>
                        <th>Customer</th>
                        <td id="v_customer"></td>
                    </tr>

                    <tr>
                        <th>Phone</th>
                        <td id="v_phone"></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td id="v_email"></td>
                    </tr>

                    <tr>
                        <th>Product</th>
                        <td id="v_product"></td>
                    </tr>

                    <tr>
                        <th>Quantity</th>
                        <td id="v_qty"></td>
                    </tr>

                    <tr>
                        <th>Price</th>
                        <td id="v_price"></td>
                    </tr>

                    <tr>
                        <th>Total</th>
                        <td id="v_total"></td>
                    </tr>

                    <tr>
                        <th>Address</th>
                        <td id="v_address"></td>
                    </tr>

                    <tr>
                        <th>Note</th>
                        <td id="v_note"></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td id="v_status"></td>
                    </tr>

                </table>

            </div>

            <div class="modal-footer">
            <form action="{{route('orders.index')}}" method="get">
                 @csrf
                <button class="btn btn-danger">
                    Cancel
                </button>
                </form>

              <form id="acceptForm" method="POST">
                    @csrf
                    @method('PATCH')

                    <button type="submit"
                            id="acceptBtn"
                            class="btn btn-success">
                        <i class="bi bi-check-circle-fill"></i>
                        Accept Order
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

<script>
document.querySelectorAll(".viewOrderBtn").forEach(button => {

    button.addEventListener("click", function () {

        document.getElementById("v_customer").innerText = this.dataset.customer;
        document.getElementById("v_phone").innerText = this.dataset.phone;
        document.getElementById("v_email").innerText = this.dataset.email || "-";
        document.getElementById("v_product").innerText = this.dataset.product;
        document.getElementById("v_qty").innerText = this.dataset.qty;
        document.getElementById("v_price").innerText = "₹" + this.dataset.price;
        document.getElementById("v_total").innerText = "₹" + this.dataset.total;
        document.getElementById("v_address").innerText = this.dataset.address;
        document.getElementById("v_note").innerText = this.dataset.note || "-";
        document.getElementById("v_status").innerText = this.dataset.status;

        // Accept Form Action
        document.getElementById("acceptForm").action =
            "/orders/" + this.dataset.id + "/accept";


            const acceptBtn = document.getElementById("acceptBtn");

                if (this.dataset.status === "Pending") {
                    acceptBtn.style.display = "inline-block";
                } else {
                    acceptBtn.style.display = "none";
                }

    });

});
</script>

@if(session('success'))
<script>
Swal.fire({
    icon:'success',
    title:'Success',
    text:'{{ session("success") }}'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon:'error',
    title:'Oops...',
    text:'{{ session("error") }}'
});
</script>
@endif

@endsection