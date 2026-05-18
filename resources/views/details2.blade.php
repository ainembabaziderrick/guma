@extends('frontend.layouts.app')

@section('home_content')

 <!--  ************************* Page Title Starts Here ************************** -->
 <div class="page-nav no-margin row">
            <div class="container">
                <div class="row">
                    <h2 class="text-start">Queen Bee Honey</h2>
                    <ul>
                        <li> <a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
                          <li><i class="bi bi-chevron-double-right pe-2"></i> Products</li>
                        <li><i class="bi bi-chevron-double-right pe-2"></i> >Comb Honey</li>
                    </ul>
                </div>
            </div>
        </div>
        
        
    <!--####################### Product Detail Starts Here ###################-->
    <div class="container-fluid big-padding bg-white about-cover">
        <div class="container">
            <div class="row about-row">
                <div class="col-md-5 p-5 text-center">
                    <img src="assets/images/h1.jpg" alt="">
                </div>
                <div class="col-md-7">
                    <h2>Queen Bee pure Organic</h2>
                    <p>Queen Bee honey, also known as royal jelly, is a highly nutritious secretion produced by worker bees and fed exclusively to the queen bee. It's rich in proteins, vitamins, and minerals, serving as the primary food source for the queen, contributing to her longevity and fertility. This special honey is believed to possess various health benefits, including immune system support and potential anti-aging properties.</p>
                    <b class="fs-3 py-4 text-danger"></b>
                     <span class="fs-5 ps-3"></span>
                     <ul class="mt-0 mt-2 mb-3 vgth">
                        <li class="fs-8">
                            <i class="bi text-warning bi-star-fill"></i>
                            <i class="bi text-warning bi-star-fill"></i>
                            <i class="bi text-warning bi-star-fill"></i>
                            <i class="bi text-warning bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <span>4,2</span>
                        </li>
                        <li class="float-end gvi">
                            <i class="bi text-danger bi-heart-fill"></i>
                        </li>
                    </ul>
                    <ul class="key-features mt-2">
                        <li><i class="bi bi-caret-right"></i> Newly Added</li>
                        <li><i class="bi bi-caret-right"></i> Made with Fresh Flowers</li>
                        <li><i class="bi bi-caret-right"></i> Well Packed</li>
                        <li><i class="bi bi-caret-right"></i> Timely Delivery</li>
                        <li><i class="bi bi-caret-right"></i> Fresh Leafes Used</li>
                        <li><i class="bi bi-caret-right"></i> Properly Packed</li>
                    </ul>
                </div>
            </div>
            <div class="row product-detail">
               <h4>Product Detail</h4>
                <p class="mb-3">Queen Bee honey, or royal jelly, is a highly nutritious substance secreted by worker bees to feed the queen bee. Rich in proteins, vitamins, and minerals, it's exclusively fed to the queen throughout her life, contributing to her remarkable longevity and fertility. This special honey is renowned for its potential health benefits, including immune system support, improved skin health, and increased vitality when consumed by humans.</p>
                <p class="mb-3">The composition of Queen Bee honey includes essential amino acids, fatty acids, and trace elements crucial for overall well-being. Its unique blend of nutrients is believed to enhance energy levels, promote tissue repair, and support the body's natural defenses against infections. Studies suggest that royal jelly may also have antioxidant properties, protecting cells from oxidative stress and contributing to a youthful appearance.</p>
                <p class="mb-3">Queen Bee honey's potential health benefits extend beyond physical wellness, as it's also associated with cognitive enhancement and stress reduction. Regular consumption of royal jelly may support brain function, memory retention, and mental clarity, making it a valuable supplement for maintaining cognitive health and overall vitality.</p>
            </div>
          
            </div>
        </div>

        @endsection