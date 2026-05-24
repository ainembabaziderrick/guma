@extends('layouts.master')

@section('title')
    Agent Commissions
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Agent Commissions</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-success btn-flat btn-sm" onclick="openCommissionModal()">
                        <i class="fa fa-plus"></i> Add Commission
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Agent</th>
                            <th>Candidate</th>
                            <th>Base Amount</th>
                            <th>Rate</th>
                            <th>Commission</th>
                            <th>Earned Date</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('commission.commission-modal')
@endsection

@push('scripts')
<script>
let table = $('.table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route('commission.data') }}',
    columns: [
        {data: 'DT_RowIndex', searchable: false, sortable: false},
        {data: 'agent_name'},
        {data: 'candidate_name'},
        {data: 'base_amount'},
        {data: 'commission_rate'},
        {data: 'commission_amount'},
        {data: 'earned_date'},
        {data: 'status'},
        {data: 'action', searchable: false, sortable: false}
    ]
});

function openCommissionModal(id = null) {
    $('#modal-commission').modal('show');
    $('#form-commission')[0].reset();
    $('#form-commission').attr('action', '{{ route('commission.store') }}');
    $('#modal-commission.modal-title').text('Add Commission');
}

$('#form-commission').on('submit', function(e) {
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize())
  .done(() => {
        $('#modal-commission').modal('hide');
        table.ajax.reload();
        toastr.success('Commission saved');
    })
  .fail(() => toastr.error('Save failed'));
});

function markPaid(id) {
    if(confirm('Mark this commission as paid?')) {
        $.post('{{ route('commission.pay') }}', {id: id, _token: '{{ csrf_token() }}'})
       .done(() => {
            table.ajax.reload();
            toastr.success('Paid');
        });
    }
}

function deleteCommission(id) {
    if(confirm('Delete this commission?')) {
        $.ajax({
            url: '/agent-commissions/'+id,
            type: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: () => table.ajax.reload()
        });
    }
}
</script>
@endpush