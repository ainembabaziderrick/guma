@extends('layouts.master')

 @section('content')
 <div class="pagetitle">
    <h1>Carousel Blog</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Carousel</h5>

                    <form action="{{ url('admin/carousel/add')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    <div class="form-group">
                         <label for="exampleFormControlInput1">Honey Type </label>
                         <input type="text" name="type" class="form-control" id="exampleFormControlInput1"
                              placeholder="Type">

                    </div>
                    
                    <div class="form-group">
                         <label for="exampleFormControlInput1">Description </label>
                         <input type="text" name="description" class="form-control" id="exampleFormControlInput1"
                              placeholder="Description">

                    </div>

                    
                    <div class="form-group">
                         <label for="exampleFormControlFile1"> Image</label>
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