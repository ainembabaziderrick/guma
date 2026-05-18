@extends('buy.layouts.master')

@section('content')
<div class="pagetitle">
    <h1>Place Order</h1>
</div>

<section class="section">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('message')
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">Orders</h5>

                    <form action="{{ url('combhoney/buy')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row mb-4">
                            <label class="col-sm-4 col-form-label">Full Names <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required><br>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-4 col-form-label">Contact <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="contact" class="form-control" placeholder="Enter your contact number" required><br>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email (optional)"><br>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-4 col-form-label">Quantity <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="quantity" class="form-control" placeholder="Enter quantity" required><br>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-4 col-form-label">Location <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="location" class="form-control" placeholder="Enter your location" required><br>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
