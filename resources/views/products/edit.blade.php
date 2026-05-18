@extends('layouts.master')

 @section('content')
 <div class="pagetitle">
    <h1>Edit Products</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>

                    <form action=" {{ url('admin/products/update/'.$cases->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <input type="hidden" name="old_image" value="{{ $cases->image}}">

                                               
                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Product Type <span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="type" class="form-control" required value="{{ $cases->type}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Image <span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="file" name="image" class="form-control"  value="{{ $cases->image}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Product Price <span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="price" class="form-control" required value="{{ $cases->price}}">
                            </div>
                        </div>
                        <div  class="form-group">
                            <img src="{{ asset($cases->image)}}" style="width: 400px; Height: 200px;" alt="">

                        </div>
                       
                      



                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label"> 
                            </label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</section>






 @endsection