@extends('layouts.master')

@section('title')
Blog List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Blog List</li>
@endsection

 @section('content')
<div class="pagetitle">
    <h1>Blog List</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-24">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                    <a href="{{ url('admin/blog/add')}}" class="btn btn-primary">Add New Blog</a>
                     </h5>
                     <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Blog</th>
                                <th scope="col">Date</th>
                                <th scope="col">Blogger</th>
                                <th scope="col">Image </th>
                                
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
    @foreach($getRecord as $value)
    <tr>
        <!-- Use the $loop->iteration to generate sequential IDs -->
        <th scope="row">{{ $loop->iteration }}</th>
        
        <td>{{ $value->blog }}</td>
        <td>{{ $value->date }}</td>
        <td>{{ $value->blogger }}</td>
        <td><img src="{{ asset($value->image) }}" style="height: 40px; width: 70px;" alt=""></td>
        <td>{{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</td>

        <td>
            <div class="btn-group">
                <a href="{{ url('admin/blog/edit/'.$value->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{ url('admin/blog/delete/'.$value->id) }}" class="btn btn-sm btn-danger">Delete</a>
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