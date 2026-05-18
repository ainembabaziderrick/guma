@extends('layouts.master')

@section('title')
Staff List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Staff List</li>
@endsection

 @section('content')
<div class="pagetitle">
    <h1>Staff List</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-24">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                    <a href="{{ url('admin/staff/add')}}" class="btn btn-primary">Add New Staff</a>
                     </h5>
                     <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">NIN</th>
                                <th scope="col">NOK</th>
                                <th scope="col">NOK_CONTACT</th>
                                <th scope="col">NOK_NIN</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($getRecord as $value)
    <tr>
    <th scope="row">{{ $loop->iteration }}</th>
        <td>{{$value->name}}</td>
        <td>{{$value->number}}</td>
        <td>{{$value->email}}</td>
        <td>{{$value->address}}</td>
        <td>{{$value->nin}}</td>
        <td>{{$value->nok}}</td>
        <td>{{$value->nok_contact}}</td>
        <td>{{$value->nok_nin}}</td>
        
        <td>{{ \Carbon\Carbon::parse($value->created_at)->setTimezone('Africa/Kampala')->format('d-m-Y H:i:s') }}</td>

        <td>
            <div class="btn-group">
                <a href="{{url('admin/staff/delete/'.$value->id)}}" class="btn btn-sm btn-danger">Delete</a>
            </div>
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