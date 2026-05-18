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
                        <!-- Add New Order button aligned to the right -->
                        <a href="{{ url('/neworders/make/online') }}" class="btn btn-primary float-end">
                            + New Order
                        </a>
                    </h5>
                    <table class="table datatable">
    <thead>
        <tr>
            <th scope="col">#</th> 
            <th scope="col">Full Names</th>
            <th scope="col">Email</th>
            <th scope="col">Product</th> <!-- ✅ New Column -->
            <th scope="col">Quantity</th>
            <th scope="col">Location</th>
            <th scope="col">Created At</th>
        </tr>
    </thead>
    <tbody>
    @forelse($getRecord as $value)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $value->name }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->type }}</td>
            <td>{{ $value->quantity }}</td>
            <td>{{ $value->location }}</td>
            <td>{{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">No orders found.</td>
        </tr>
    @endforelse
</tbody>

</table>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
