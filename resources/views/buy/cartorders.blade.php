@extends('layouts.master')

@section('title')
    Cart Orders List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Orders List</li>
@endsection

@section('content')
<div class="pagetitle">
    <h1>Cart Orders List</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-12"> <!-- Fixed to proper Bootstrap column -->
            @include('message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>

                    <!-- Table Responsive Wrapper -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="orders-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Names</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Location</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DataTables will populate -->
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table Responsive -->

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#orders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('cart.data') }}',
        scrollX: true, // enables horizontal scrolling
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'contact', name: 'contact' },
            { data: 'email', name: 'email' },
            { data: 'product_name', name: 'product_name' },
            { data: 'quantity', name: 'quantity' },
            { data: 'location', name: 'location' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Handle delete button click
    $('#orders-table').on('click', '.delete-order', function() {
        if (!confirm('Are you sure you want to delete this order?')) return;

        var button = $(this);
        var url = button.data('url');

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                table.ajax.reload(null, false); // Reload without resetting pagination
                alert('Order deleted successfully.');
            },
            error: function(xhr) {
                alert('Failed to delete the order.');
            }
        });
    });
});
</script>
@endpush
