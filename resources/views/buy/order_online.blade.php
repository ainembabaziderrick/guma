@extends('layouts.master')

@section('content')

<div class="container-fluid products big-padding px-3 bg-honey">
    <div class="container-xl">
        <div class="section-title row">
            <h2 class="fs-1 fw-bold">Our Products</h2>
            <p>Pure bee products sourced sustainably, unmatched in quality and purity. Our commitment to natural
                processes ensures superior taste and potent health benefits, setting us apart in the market.</p>
        </div>
        <div class="row">
        @foreach($products as $value)
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="product bg-white p-4 text-center shadow-md">
                <!-- Product Image -->
                <img src="{{ asset($value->image) }}" alt="" class="img-fluid d-block mx-auto">

                <!-- Product Title -->
                <h4 class="fw-bolder fs-5 mt-4"> {{$value->type}} </h4>
                <h2 class="fw-bolder fs-5 mt-4">Ugx {{$value->price}} </h2>

                <!-- Add to Cart Button -->
                <div class="d-inline-block mt-3">
                    <a href="{{ route('add.to.cart.online', ['product_id' => $value->id]) }}" 
                       class="btn btn-primary px-5">
                        Add To Cart
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        </div>
    </div>
</div>

@endsection
