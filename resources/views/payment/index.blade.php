@extends('layouts.master')

@section('title')
    Payments
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Payments</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Candidate Payments</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-success btn-flat btn-sm" onclick="openPaymentModal()">
                        <i class="fa fa-plus"></i> Add Payment
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Candidate</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Reference</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('payment.payment-modal')
@endsection

@push('scripts')
<script>
let table;

$(function () {
    table = $('.table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{{ route('payment.data') }}',
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'candidate_name'},
            {data: 'type'},
            {data: 'amount'},
            {data: 'payment_method'},
            {data: 'reference_no'},
            {data: 'payment_date'},
            {data: 'status'},
            {data: 'action', searchable: false, sortable: false}
        ]
    });
});

function openPaymentModal(id = null) {
    $('#modal-payment').modal('show');
    $('#form-payment')[0].reset();

    if (id) {
        $.get('/payments/'+id+'/edit').done((res) => {
            $('#form-payment').attr('action', '{{ route('payment.update') }}');
            $.each(res, function(key, value){
                $('#form-payment [name='+key+']').val(value);
            });
            $('#modal-payment.modal-title').text('Edit Payment');
        });
    } else {
        $('#form-payment').attr('action', '{{ route('payment.store') }}');
        $('#modal-payment.modal-title').text('Add Payment');
    }
}

$('#form-payment').on('submit', function(e) {
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize())
   .done(() => {
        $('#modal-payment').modal('hide');
        table.ajax.reload();
        toastr.success('Payment saved');
    })
   .fail(() => toastr.error('Save failed'));
});

function deletePayment(id) {
    if(confirm('Delete this payment?')) {
        $.ajax({
            url: '/payments/'+id,
            type: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: () => {
                table.ajax.reload();
                toastr.success('Payment deleted');
            }
        });
    }
}
</script>
@endpush