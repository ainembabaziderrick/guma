@extends('layouts.master')

@section('title', 'Orders List')

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
        <div class="col-lg-12">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ url('admin/orders/add')}}" class="btn btn-primary">Add New Order</a>
                    </h5>

                    <!-- Table responsive for horizontal scroll -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="orders-table">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Full Names</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Location</th>
                                    <th>Created At</th>
                                    <th width="10%">Action</th>
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
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(function () {
        const table = $('#orders-table').DataTable({
            responsive: false,    // disable to allow horizontal scroll
            scrollX: true,        // enable horizontal scroll
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: '{{ route('orders.data') }}', // your route returning JSON
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false }, // index #
                { data: 'name', name: 'name' },
                { data: 'contact', name: 'contact' },
                { data: 'email', name: 'email' },
                { data: 'product', name: 'product' },
                { data: 'quantity', name: 'quantity' },
                { data: 'location', name: 'location' },
                { data: 'created_at', name: 'created_at' },
                {
                    data: 'action', 
                    orderable: false, 
                    searchable: false
                }
            ]
        });

        // Delete function
        window.deleteOrder = function(url) {
            if (confirm('Are you sure you want to delete this order?')) {
                $.post(url, {
                    _token: '{{ csrf_token() }}',
                    _method: 'delete'
                })
                .done(() => table.ajax.reload())
                .fail(() => alert('Unable to delete order'));
            }
        }
    });
</script>
@endpush
