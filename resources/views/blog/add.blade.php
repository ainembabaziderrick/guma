@extends('layouts.master')

 @section('content')
 <div class="pagetitle">
    <h1>Add Blog</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Blog</h5>

                    <form action="{{ url('admin/blog/add')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    <div class="form-group">
                         <label for="exampleFormControlInput1">Blog </label>
                         <input type="text" name="blog" class="form-control" id="exampleFormControlInput1"
                              placeholder="Blog">

                    </div>
                    <div class="form-group">
                         <label for="exampleFormControlInput1">Date </label>
                         <input type="date" name="date" id="">

                    </div>
                    <div class="form-group">
                         <label for="exampleFormControlInput1">Blogger </label>
                         <input type="text" name="blogger" class="form-control" id="exampleFormControlInput1"
                              placeholder="Blogger">

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