@extends('user.layout.app')

@section('title','My Cart')

@section('content')
{{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}

<div class="container py-5">

    <div class="row">

        {{-- Cart Items --}}
        <div class="col-lg-8">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 fw-bold">
                        🛒 My Shopping Cart
                    </h4>
                </div>

                <div class="card-body">

                    @forelse($carts as $cart)

                    <div class="row align-items-center border-bottom py-3">

                        {{-- Image --}}
                        <div class="col-md-2 text-center">

                            <img src="{{ asset('storage/'.$cart->product->product_image) }}"
                                 class="img-fluid rounded"
                                 style="height:90px;width:90px;object-fit:cover;">

                        </div>

                        {{-- Product --}}
                        <div class="col-md-4">

                            <h5 class="mb-1">
                                {{ $cart->product->productname }}
                            </h5>

                            <span class="text-success fw-bold">
                                ₹{{ number_format($cart->price,2) }}
                            </span>

                        </div>

                        {{-- Quantity --}}
                        <div class="col-md-3">

    <div class="input-group">

        <button class="btn btn-outline-secondary qty-btn minus"
                data-id="{{ $cart->id }}">
            -
        </button>

        <input type="text"
               id="qty{{ $cart->id }}"
               value="{{ $cart->quantity }}"
               class="form-control text-center"
               readonly>

        <button class="btn btn-outline-secondary qty-btn plus"
                data-id="{{ $cart->id }}">
            +
        </button>

    </div>

</div>

                        {{-- Subtotal --}}
                                <div class="col-md-2 text-center">

                                    <strong id="subtotal{{ $cart->id }}">
                                        ₹{{ number_format($cart->price * $cart->quantity,2) }}
                                    </strong>

                                </div>

                        {{-- Remove --}}
                        <div class="col-md-1 text-end">

                            <form action="{{ route('cart.destroy', $cart->id) }}"
                                method="POST"
                                class="deleteCartForm">

                                @csrf
                                @method('DELETE')

                                <button type="button"
                                        class="btn btn-danger btn-sm rounded-circle deleteBtn">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                            
                        </div>

                    </div>

                    @empty

                    <div class="text-center py-5">

                        <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
                             width="140">

                        <h4 class="mt-3">
                            Your Cart is Empty
                        </h4>

                        <a href="{{ route('home') }}"
                           class="btn btn-success mt-3">

                            Continue Shopping

                        </a>

                    </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- Summary --}}
        <div class="col-lg-4">

            <div class="card shadow border-0 rounded-4 sticky-top"
                 style="top:100px;">

                <div class="card-header bg-dark text-white">

                    <h5 class="mb-0">
                        Order Summary
                    </h5>

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">

                        <span>Items</span>

                        <span>{{ $carts->count() }}</span>

                    </div>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Total</span>

                        <strong id="grandTotal" class="text-success fs-5">
    ₹{{ number_format($total,2) }}
</strong>

                    </div>

                    <hr>

                    <a href="{{route('checkout.index')}}" class="btn btn-success w-100 py-2">
                        Proceed To Checkout
                    </a>

                    <a href="{{ route('home') }}"
                       class="btn btn-outline-dark w-100 mt-2">

                        Continue Shopping

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
@push('scripts')
<script>

$(document).ready(function () {

    // ==========================
    // PLUS BUTTON
    // ==========================
    $(document).on('click', '.plus', function () {

        let id = $(this).data('id');
        let qty = parseInt($('#qty' + id).val());

        qty++;

        updateCart(id, qty);

    });

    // ==========================
    // MINUS BUTTON
    // ==========================
    $(document).on('click', '.minus', function () {

        let id = $(this).data('id');
        let qty = parseInt($('#qty' + id).val());

        if (qty > 1) {
            qty--;
            updateCart(id, qty);
        }

    });

    // ==========================
    // UPDATE CART AJAX
    // ==========================
    function updateCart(id, qty) {

        $.ajax({

            url: "{{ url('/cart/update') }}/" + id,

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                quantity: qty
            },

            success: function (res) {

                $('#qty' + id).val(res.quantity);

                $('#subtotal' + id).html(
                    "₹" + Number(res.subtotal).toFixed(2)
                );

                $('#grandTotal').html(
                    "₹" + Number(res.grandTotal).toFixed(2)
                );

            },

            error: function (xhr) {

                console.log(xhr.responseText);

            }

        });

    }

    // ==========================
    // DELETE ITEM AJAX
    // ==========================
    $(document).on('click', '.deleteBtn', function () {

        let form = $(this).closest('form');
        let row = $(this).closest('.row');

        Swal.fire({

            title: 'Remove Item?',
            text: 'This product will be removed from your cart.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Yes, Remove'

        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    url: form.attr('action'),

                    type: "POST",

                    data: {

                        _token: "{{ csrf_token() }}",
                        _method: "DELETE"

                    },

                    success: function (res) {

                        row.fadeOut(300, function () {
                            $(this).remove();
                        });

                        $('#grandTotal').html(
                            "₹" + Number(res.grandTotal).toFixed(2)
                        );

                        Swal.fire({

                            icon: 'success',
                            title: 'Removed!',
                            text: 'Item removed successfully.',
                            timer: 1200,
                            showConfirmButton: false

                        });

                    },

                    error: function (xhr) {

                        console.log(xhr.responseText);

                    }

                });

            }

        });

    });

});

</script>
@endpush