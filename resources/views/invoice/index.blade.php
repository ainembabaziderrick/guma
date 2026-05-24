@extends('layouts.master')

@section('title')
    Invoices
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Invoices</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('invoice.create') }}" class="btn btn-success btn-flat btn-sm">
                        <i class="fa fa-plus"></i> Create Invoice
                    </a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Invoice No</th>
                            <th>Candidate</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
let table = $('.table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route('invoice.data') }}',
    columns: [
        {data: 'DT_RowIndex', searchable: false, sortable: false},
        {data: 'invoice_no'},
        {data: 'candidate_name'},
        {data: 'invoice_date'},
        {data: 'total'},
        {data: 'status'},
        {data: 'action', searchable: false, sortable: false}
    ]
});

function deleteInvoice(id) {
    if(confirm('Delete this invoice?')) {
        $.ajax({
            url: '/invoices/'+id,
            type: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: () => table.ajax.reload()
        });
    }
}
</script>
@endpush
@endsection