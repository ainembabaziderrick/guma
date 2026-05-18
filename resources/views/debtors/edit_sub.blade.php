@extends('layouts.master')

 @section('content')
 <div class="pagetitle">
    <h1>Clear Debtors</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Debtors</h5>

                    <form action="{{ url('sub/debtors/update/'.$debts->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field()}}

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Name <span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" required value="{{ $debts->name}}" readonly> <br>
                            </div>
                        </div>

                       

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Amount<span style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="amount" class="form-control" required value="{{ $debts->amount}}"> <br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label">Date<span style="color: red;"></span>
                            </label>
                            <div class="col-sm-10">
                            <input type="date" name="date" class="form-control" required value="{{ $debts->date}}"> <br>
                            </div>
                        </div>

                      
                        <div class="row mb-3">
                            <label class = "col-sm-2 col-form-label"> 
                            </label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Pay</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</section>






 @endsection