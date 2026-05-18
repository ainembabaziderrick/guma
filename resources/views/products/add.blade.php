@extends('layouts.master')

 @section('content')
 <div class="pagetitle">
    <h1>Add Products</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>

                    <form action="{{ url('admin/products/add')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    <div class="form-group">
                         <label for="exampleFormControlInput1">Type </label>
                         <input type="text" name="type" class="form-control" id="exampleFormControlInput1"
                              placeholder="Product Type">

                    </div>
                    <div class="form-group">
                         <label for="exampleFormControlInput1">Price </label>
                         <input type="text" name="price" class="form-control" id="exampleFormControlInput1"
                              placeholder="Product Price">

                    </div>

                    
                    <div class="form-group">
                         <label for="exampleFormControlFile1">Product Image</label>
                         <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                         <button type="submit" class="btn btn-primary btn-default">Submit</button>

                    </div>
               </form>
                </div>
            </div>
        </div>
    </div>

</section>






 @endsection