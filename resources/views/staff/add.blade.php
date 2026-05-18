@extends('layouts.master')

 @section('content')
 <div class="pagetitle">
    <h1>Add Staff</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Staff</h5>

                    <form action=" {{ url('admin/staff/add')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field()}}

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Name <span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" required><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Number <span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="number" class="form-control" required><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Email <span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" required><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Location <span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="address" name="address" class="form-control" required><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">NIN<span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="nin" class="form-control" required><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">NOK<span style="color: red;"></span>
                            </label>
                            <div class="col-sm-10">
                            <input type="text" name="nok" class="form-control" required><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">NOK CONTACT<span style="color: red;"></span>
                            </label>
                            <div class="col-sm-10">
                            <input type="text" name="nok_contact" class="form-control" required><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">NOK NIN<span style="color: red;"></span>
                            </label>
                            <div class="col-sm-10">
                            <input type="text" name="nok_nin" class="form-control" required><br>
                            </div>
                        </div>

                      
                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label"> 
                            </label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</section>






 @endsection