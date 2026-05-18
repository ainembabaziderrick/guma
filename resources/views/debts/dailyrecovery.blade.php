@extends('layouts.master')

@section('title')
    Debts Recovery List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Debtors Recovery List</li>
@endsection

@section('content')
<div class="pagetitle">
    <h1>Daily Debts Recovery List</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-24">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($getRecord as $index => $value)
                            <tr>
                                <!-- Use $loop->iteration or $index + 1 to get a simple incrementing ID -->
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $value->debtor ? $value->debtor->name : 'N/A' }}</td>
                                <td>{{ $value->amount }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->date)->setTimezone('Africa/Kampala')->format('d-m-Y') }}</td>

                                <td>{{ \Carbon\Carbon::parse($value->created_at)->setTimezone('Africa/Kampala')->format('d-m-Y H:i:s') }}</td>
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
