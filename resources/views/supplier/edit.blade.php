@extends('layouts.master')

 @section('content')
 <div class="pagetitle">
    <h1>Edit Supply Details</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Supply Details</h5>

                    <form action="{{ url('suplier/update/'.$debts->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field()}}

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Supplier <span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="supplier" class="form-control" required value="{{ $debts->supplier}}"><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Quantity <span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="quantity" class="form-control" required value="{{ $debts->quantity}}"><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Total Price<span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="total" class="form-control" required value="{{ $debts->total}}"><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Amount Paid<span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="paid" class="form-control" required value="{{ $debts->paid}}"><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Date<span style="color: red;"></span>
                            </label>
                            <div class="col-sm-10">
                            <input type="date" name="date" class="form-control"  value="{{ $debts->date}}"><br>
                            </div>
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