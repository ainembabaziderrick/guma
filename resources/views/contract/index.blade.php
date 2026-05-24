@extends('layouts.master')

@section('title')
    Contracts
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Contracts</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Candidate Contracts</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Full Name</th>
                            <th>Position Applied</th>
                            <th>Contract Status</th>
                            <th>Contract Date</th>
                            <th>File</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('contract.contract-modal')
@includeIf('candidates.view-modal')
@endsection

@push('scripts')
<script>
let table;

$(function () {
    table = $('.table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{{ route('contract.data') }}',
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'full_name'},
            {data: 'position_applied'},
            {data: 'contract_status'},
            {data: 'contract_date'},
            {data: 'contract_file'},
            {data: 'action', searchable: false, sortable: false}
        ]
    });
});

function openContractModal(id) {
    $.get('/candidates/'+id).done((res) => {
        $('#modal-contract').modal('show');
        $('#modal-contract form').attr('action', '{{ route('contract.update') }}');
        $('#modal-contract [name=id]').val(res.id);
        $('#modal-contract [name=contract_status]').val(res.contract_status);
        $('#modal-contract [name=contract_date]').val(res.contract_date);
        $('#modal-contract [name=contract_notes]').val(res.contract_notes);
        $('#modal-contract .modal-title').text('Contract - ' + res.full_name);
    });
}

$('#form-contract').on('submit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: () => {
            $('#modal-contract').modal('hide');
            table.ajax.reload();
            toastr.success('Contract updated');
        },
        error: () => toastr.error('Update failed')
    });
});
</script>
@endpush