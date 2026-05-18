@extends('frontend.layouts.app')

@section('home_content')
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
                        @foreach($cart as $id => $item)
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
                            <td>UGX {{ number_format($item['price'] * $item['quantity']) }}</td>
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
                    <h4 class="fw-bold mb-3">Delivery Details</h4>
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Delivery Address</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Delivery Address" required></textarea>
                        </div>

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

                        <input type="hidden" name="total" value="{{ $total }}">

                        <button type="submit" class="btn btn-success w-100 py-2 fw-bold">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
