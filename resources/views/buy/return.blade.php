@extends('layouts.master')

@section('content')
<div class="pagetitle">
    <h1>Make an Order</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>

                    <!-- Big Button to Return to Dashboard -->
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg mt-3">
                        Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
