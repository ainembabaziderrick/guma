@extends('frontend.layouts.app')

@section('home_content')
@include('message')
<!-- Add to Cart Page -->
<div class="container py-5">
    <div class="row">
        <!-- Product Image on the left -->
        <div class="col-lg-6 col-md-6 mb-4">
            <img src="{{ asset($product->image) }}" alt="{{ $product->type }}" class="img-fluid rounded">
        </div>

        <!-- Product Details on the right -->
        <div class="col-lg-6 col-md-6 mb-4">
            <h2>{{ $product->type }}</h2>
            <p class="lead">Price: Ugx {{ number_format($product->price, 0) }}</p>
            <p class="text-muted">Pure, sustainably sourced, high-quality honey. Add this to your cart and enjoy the sweetness!</p>
            
            <!-- Form to add product to cart -->
            <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <!-- Hidden Inputs for Product Data -->
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="product_name" value="{{ $product->type }}">
    <input type="hidden" name="product_price" value="{{ $product->price }}">
    <input type="hidden" name="product_image" value="{{ $product->image }}">

    <!-- Product Image -->
    <div class="mb-3 text-center">
        <img src="{{ asset($product->image) }}" alt="{{ $product->type }}" class="img-fluid rounded" width="200">
    </div>

    <!-- Product Title & Price -->
    <h2 class="text-center">{{ $product->type }}</h2>
    <p class="lead text-center">Price: Ugx {{ number_format($product->price, 0) }}</p>

    <!-- Quantity Input -->
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="text" name="quantity" id="quantity" class="form-control" value="1" min="1" required>
    </div>

    <!-- User Information Fields -->
    <div class="mb-3">
        <label for="name" class="form-label">Names</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" required>
    </div>

    <div class="mb-3">
        <label for="contact" class="form-label">Contact</label>
        <input type="text" name="contact" id="contact" class="form-control" placeholder="Phone Number" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com" required>
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Address</label>
        <textarea name="location" id="location" class="form-control" placeholder="Your address" required></textarea>
    </div>

    <!-- Add to Cart Button -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg">Add to Cart</button>
    </div>
</form>

        </div>
    </div>
</div>

@endsection
