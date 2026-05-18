@extends('frontend.layouts.app')

@section('home_content')

 <!--  ************************* Page Title Starts Here ************************** -->
 <div class="page-nav no-margin row">
            <div class="container">
                <div class="row">
                    <h2 class="text-start">Wild Flower Honey</h2>
                    <ul>
                        <li> <a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
                          <li><i class="bi bi-chevron-double-right pe-2"></i> Products</li>
                        <li><i class="bi bi-chevron-double-right pe-2"></i> >Wild Flower Honey</li>
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
                    <h2>Wild Flower Honey pure Organic</h2>
                    <p>Wildflower honey is made by bees that collect nectar from a diverse array of wildflowers, resulting in a unique, multifaceted flavor and aroma. This natural variation in nectar sources gives it a distinctive taste profile, which can vary seasonally and regionally. Rich in antioxidants and enzymes, wildflower honey offers numerous health benefits and a delicious, authentic sweetness.</p>
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
                <p class="mb-3">Wildflower honey is produced by bees that forage on a diverse mix of wildflowers, giving it a unique, multifaceted flavor profile that varies by season and region. This variety of nectar sources contributes to its complex and rich taste, making each batch distinct. Its color can range from light to dark, depending on the flowers in bloom.</p>
                <p class="mb-3">Rich in antioxidants, enzymes, and natural nutrients, wildflower honey offers numerous health benefits, including immune support and antibacterial properties. Its diverse floral origins enhance its nutritional value, making it a sought-after choice for those seeking a wholesome, natural sweetener. The minimal processing ensures that it retains its beneficial compounds and natural goodness.</p>
                <p class="mb-3">Wildflower honey's versatile flavor makes it an excellent addition to a variety of culinary applications. It can be used to sweeten teas, drizzle over yogurt or toast, or incorporated into baking and cooking. Its unique taste enhances both sweet and savory dishes, providing a natural and flavorful alternative to processed sugars and artificial sweeteners.</p>
            </div>
          
            </div>
        </div>

        @endsection