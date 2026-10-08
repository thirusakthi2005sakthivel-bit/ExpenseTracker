@extends('user.layout.app')

@section('title','Checkout')

@section('content')

<div class="container py-5">

    <div class="row">

        {{-- Customer Details --}}
        <div class="col-lg-7">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">📍 Delivery Details</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('checkout.placeOrder') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>

                            <input type="text"
                                   name="customer_name"
                                   class="form-control"
                                   value="{{ Auth::user()->name }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>

                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Delivery Address</label>

                            <textarea name="address"
                                      rows="4"
                                      class="form-control"
                                      required></textarea>
                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Payment Method
                            </label>

                            <select name="payment_method"
                                    class="form-select">

                                <option value="Cash On Delivery">
                                    Cash On Delivery
                                </option>

                            </select>

                        </div>

                        <button class="btn btn-success w-100 py-2">

                            🛍 Place Order

                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- Order Summary --}}
        <div class="col-lg-5">

            <div class="card shadow border-0 rounded-4 sticky-top"
                 style="top:100px;">

                <div class="card-header bg-dark text-white">

                    <h4 class="mb-0">
                        🧾 Order Summary
                    </h4>

                </div>

                <div class="card-body">

                    @foreach($carts as $cart)

                    <div class="d-flex align-items-center mb-3">

                        <img src="{{ asset('storage/'.$cart->product->product_image) }}"
                             width="70"
                             height="70"
                             class="rounded me-3"
                             style="object-fit:cover;">

                        <div class="flex-grow-1">

                            <h6 class="mb-1">
                                {{ $cart->product->productname }}
                            </h6>

                            Qty :
                            {{ $cart->quantity }}

                        </div>

                        <strong>

                            ₹{{ number_format($cart->price * $cart->quantity,2) }}

                        </strong>

                    </div>

                    <hr>

                    @endforeach


                    <div class="d-flex justify-content-between">

                        <h5>Total</h5>

                        <h4 class="text-success">

                            ₹{{ number_format($total,2) }}

                        </h4>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection