@extends('layouts.master')

@section('title')
Supply Details
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Supply Details</li>
@endsection

 @section('content')
<div class="pagetitle">
    <h1>Supply Details</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-24">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                    <a href="{{ url('supplies/add')}}" class="btn btn-primary">Add New Supply Details</a>
                     </h5>
                     <table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Supplier</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total Price</th>
            <th scope="col">Amount Paid</th>
            <th scope="col">Date</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- DataTables will automatically populate the table body -->
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
    $('.table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{{ route('supplies.data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false },
            { data: 'supplier', name: 'supplier' },
            { data: 'quantity', name: 'quantity' },
            { data: 'total', name: 'total' },
            { data: 'paid', name: 'paid' },
            { data: 'date', name: 'date' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});


</script>

@endpush
