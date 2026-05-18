@extends('layouts.master')

@section('title')
Orders List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Orders List</li>
@endsection

 @section('content')
<div class="pagetitle">
    <h1>Orders List</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-24">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                    <a href="{{ url('admin/orders/add')}}" class="btn btn-primary">Add New Order</a>
                     </h5>
                     <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Full Names</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quantity</th>
                                
                                <th scope="col">Location</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($orders  as $value)
                            <tr>
                            <th scope="row">{{$value->id}}</th>
                                <td>{{$value->name}}</td>
                                <td>{{$value->contact}}</td>
                                <td>{{$value->email}}</td>
                                <td>{{$value->quantity}}</td>
                                <td>{{$value->location}}</td>
                                
                                <td>{{ date('d-m-Y H:i:s',strtotime($value->created_at))}}</td>

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