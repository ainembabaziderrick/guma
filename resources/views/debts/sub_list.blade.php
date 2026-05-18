@extends('layouts.master')

@section('title')
    Debts List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Debts List</li>
@endsection

@section('content')
<div class="pagetitle">
    <h1>Debts List</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-24">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">
                        <a href="{{ url('admin/debts/add')}}" class="btn btn-primary">Add New Debts</a>
                    </h5> -->
                    <table class="table table-striped table-bordered" id="debts-table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Created At</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables will populate the body -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#debts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('debts.sub_data') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'amount', name: 'amount' },
                { data: 'date', name: 'date' },
                { data: 'created_at', name: 'created_at' },
                
            ]
        });
    });
</script>
@endpush
