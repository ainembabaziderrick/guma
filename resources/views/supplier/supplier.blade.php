@extends('layouts.master')

@section('title')
My Supplies
@endsection

@section('breadcrumb')
    @parent
    <li class="active">My Supplies</li>
@endsection

@section('content')
<div class="pagetitle">
    <h1>My Supplies</h1>
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
                                <th scope="col">Supplier</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Amount Paid</th>
                                <th scope="col">Date</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($getRecord as $value)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$value->supplier}}</td>
                                <td>{{$value->quantity}}</td>
                                <td>{{$value->total}}</td>
                                <td>{{$value->paid}}</td>
                                <td>{{ \Carbon\Carbon::parse($value->date)->format('Y-m-d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('Y-m-d H:i:s') }}</td>
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