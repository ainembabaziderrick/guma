@extends('layouts.master')

@section('content')

<div class="container my-5">
    <h2 class="fw-bold mb-4">Checkout</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <!-- Cart Summary -->
        <div class="col-md-7">
            <h4 class="fw-bold mb-3">Your Order</h4>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @foreach($cart as $id => $item)
                            @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item['image']) }}" width="60" class="me-2 rounded">
                                        <div>{{ $item['name'] }}<br>
                                            <small>UGX {{ number_format($item['price']) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>UGX {{ number_format($subtotal) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Customer Details & Summary -->
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">Order Details</h4>
                    <form action="{{ route('checkout.process.online') }}" method="POST">
                        @csrf

                        <!-- Hidden inputs for logged-in user -->
                        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                        <input type="hidden" name="phone" value="{{ auth()->user()->contact }}">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                        <input type="hidden" name="address" value="{{ auth()->user()->address ?? '' }}">
                        <input type="hidden" name="total" value="{{ $total }}">

                        <h5 class="fw-bold mt-4">Order Summary</h5>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Subtotal</span>
                                <strong>UGX {{ number_format($total) }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Delivery Fee</span>
                                <strong>UGX 0</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total</span>
                                <strong>UGX {{ number_format($total) }}</strong>
                            </li>
                        </ul>

                        <button type="submit" class="btn btn-success w-100 py-2 fw-bold">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
