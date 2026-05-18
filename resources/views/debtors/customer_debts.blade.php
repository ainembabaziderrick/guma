@extends('layouts.master')

@section('title')
Debtors List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">MY DEBTS</li>
@endsection

 @section('content')
<div class="pagetitle">
    <h1>MY DEBTS</h1>
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

                        @foreach($getRecord as $value)
                            <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->name}}</td>
                                <td>{{$value->description}}</td>
                                <td>{{$value->amount}}</td>
                                
                                <td>{{$value->date}}</td>
                                
                                <td>
                                        
                                    </td>
                                
                            </tr>
                            @endforeach

                        </tbody>

                     </table>
                </div>
            </div>
        </div>
    </div>
</section>






 @endsection