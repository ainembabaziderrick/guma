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
        <div class="col-lg-12">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ url('admin/debtors/add') }}" class="btn btn-primary">Add New Debtors</a>
                    </h5>
                    <table class="table table-striped table-bordered" id="debts-table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Status</th>  {{-- NEW --}}
                                <th scope="col">Action</th>
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
        var table = $('#debts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('debtor.data') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'amount', name: 'amount' },
                { data: 'date', name: 'date' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status', orderable:false, searchable:false }, // NEW
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Approve button
        $(document).on('click', '.approve-debtor', function() {
            var debtorId = $(this).data('id');
            if (confirm('Approve this debtor?')) {
                $.ajax({
                    url: '{{ route("debtor.approve") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: debtorId
                    },
                    success: function(response) {
                        alert(response.message);
                        table.ajax.reload();
                    },
                    error: function() {
                        alert('Error approving debtor.');
                    }
                });
            }
        });

        // Deny button
        $(document).on('click', '.deny-debtor', function() {
            var debtorId = $(this).data('id');
            if (confirm('Deny this debtor?')) {
                $.ajax({
                    url: '{{ route("debtor.deny") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: debtorId
                    },
                    success: function(response) {
                        alert(response.message);
                        table.ajax.reload();
                    },
                    error: function() {
                        alert('Error denying debtor.');
                    }
                });
            }
        });

        // Delete button
        $(document).on('click', '.delete-debtor', function() {
            var debtorId = $(this).data('id');
            if (confirm('Are you sure you want to delete this debtor?')) {
                $.ajax({
                    url: '{{ route("debtor.delete") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: debtorId
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            table.ajax.reload();
                        } else {
                            alert(response.error);
                        }
                    },
                    error: function() {
                        alert('Error deleting debtor.');
                    }
                });
            }
        });
    });
</script>
@endpush
