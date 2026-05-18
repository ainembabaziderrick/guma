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
        <div class="col-lg-12">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">
                    <a href="{{ url('admin/orders/add')}}" class="btn btn-primary">Add New Order</a>
                    </h5> -->
                    <table class="table table-striped table-bordered" id="orders-table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Full Names</th>
        <th scope="col">Contact</th>
        <th scope="col">Email</th>
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Location</th>
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
    var table = $('#orders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('cart.sub_data') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'contact', name: 'contact' },
            { data: 'email', name: 'email' },
            { data: 'product_name', name: 'product_name' },
            { data: 'quantity', name: 'quantity' },
            { data: 'location', name: 'location' },
            { data: 'created_at', name: 'created_at' },
            
        ]
    });

    // Handle delete click
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
