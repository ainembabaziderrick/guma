@php 
    $carousel = DB::table('carousel')->get();
@endphp

<!-- ##################### Slider Starts Here #################### -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
    <div class="carousel-indicators">
        @foreach ($products as $key => $value)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" 
                    class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" 
                    aria-label="Slide {{ $key + 1 }}"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach($carousel as $key => $value)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ $value->image }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-md-block">
                    <div class="row">
                        <div class="col-lg-6 text-start">
                            <h1 class="fs-12 fw-bolder text-start">
                                {{ $value->type }} <br><span class="text-primary">online shop</span>
                            </h1>
                            <p class="text-dark d-none d-md-block text-start">{{ $value->description }}</p>
                            <div class="d-inline-block pt-5 text-start d-none d-lg-block">
                                <button class="btn btn-primary shadow fs-5 fw-bolder px-5 py-2">Buy Now</button>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-block">
                            <img class="w-100" src="{{ asset('assets/images/h2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true">
            <i class="bi fs-4 text-dark bi-chevron-left"></i>
        </span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true">
            <i class="bi fs-4 text-dark bi-chevron-right"></i>
        </span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
