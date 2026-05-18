@extends('frontend.layouts.app')

@section('home_content')

 <!--  ************************* Page Title Starts Here ************************** -->
 <div class="page-nav no-margin row">
            <div class="container">
                <div class="row">
                    <h2 class="text-start">Raw Honey</h2>
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
                    <h2>Raw Honey pure Organic</h2>
                    <p>Raw honey is unprocessed, unpasteurized honey straight from the hive, preserving its natural enzymes, vitamins, and antioxidants. Unlike commercial honey, it retains pollen, propolis, and a richer flavor. This pure form offers numerous health benefits, including antibacterial properties and immune support, making it a nutritious and authentic sweetener preferred by those seeking the full benefits of honey.</p>
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
                <p class="mb-3">Raw honey is unprocessed and unpasteurized, straight from the hive, ensuring it retains all its natural enzymes, vitamins, and minerals. This honey is not heated or filtered, preserving its beneficial compounds like pollen and propolis. Its rich, complex flavor and natural crystallization set it apart from regular, processed honey.</p>
                <p class="mb-3">Harvested with minimal interference, raw honey maintains its potent antibacterial and antioxidant properties. These attributes make it a popular choice for health enthusiasts seeking natural remedies and immune support. Unlike commercial honey, raw honey's authenticity and purity provide a more nutritious and wholesome sweetener option.</p>
                <p class="mb-3">Beyond its health benefits, raw honey's texture and taste make it a versatile ingredient in various culinary applications. It can be used in teas, baking, or as a natural sweetener in recipes. Its unique, robust flavor enhances dishes, making raw honey a favored choice for those who appreciate natural, nutrient-rich foods.</p>
            </div>
          
            </div>
        </div>

        @endsection