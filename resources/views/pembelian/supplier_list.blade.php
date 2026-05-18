@extends('layouts.master')

@section('title')
Debtors List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Debtors List</li>
@endsection

 @section('content')
<div class="pagetitle">
    <h1>Debtors List</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-24">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                   
                     </h5>
                     <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                        
                        </tbody>

                     </table>
                </div>
            </div>
        </div>
    </div>
</section>






 @endsection