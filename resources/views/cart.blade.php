@extends('frontend.layouts.app')

@section('home_content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cart && count($cart) > 0)
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @foreach($cart as $id => $details)
                    @php $subtotal = $details['price'] * $details['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td>
                            <img src="{{ asset($details['image']) }}" width="70" class="me-2">
                            {{ $details['name'] }}
                        </td>
                        <td>UGX {{ number_format($details['price']) }}</td>
                        <td width="120">
                            <input type="number" value="{{ $details['quantity'] }}" min="1" max="20" class="form-control quantity" data-id="{{ $id }}">
                        </td>
                        <td>UGX {{ number_format($subtotal) }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end fs-5 fw-bold">
            Total: UGX {{ number_format($total) }}
        </div>
        <div class="text-end mt-3">
            <a href="{{ url('/checkout') }}" class="btn btn-success px-4">Proceed to Checkout</a>
        </div>
    </div>
    @else
        <div class="alert alert-info">Your cart is empty.</div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(".quantity").change(function (e) {
    e.preventDefault();
    var ele = $(this);
    $.ajax({
        url: '{{ route('update.cart') }}',
        method: "post",
        data: {
            _token: '{{ csrf_token() }}',
            id: ele.attr("data-id"),
            quantity: ele.val()
        },
        success: function (response) {
            window.location.reload();
        }
    });
});

$(".remove-from-cart").click(function (e) {
    e.preventDefault();
    var ele = $(this);
    if(confirm("Are you sure you want to remove this product?")) {
        $.ajax({
            url: '{{ route('remove.from.cart') }}',
            method: "post",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.attr("data-id")
            },
            success: function (response) {
                window.location.reload();
            }
        });
    }
});
</script>
@endsection
