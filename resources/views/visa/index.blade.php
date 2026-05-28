@extends('layouts.master')

@section('title')
    Visa Processing
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Visa Processing</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Candidates Visa Documents</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Candidate Name</th>
                            <th>Document Title</th>
                            <th>Type</th>
                            <th>Uploaded On</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('visa.visa-modal')
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
        ajax: '{{ route('visa.data') }}',
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'candidate_name'},
            {data: 'title'},
            {data: 'type'},
            {data: 'created_at'},
            {data: 'action', searchable: false, sortable: false}
        ]
    });
});

function openVisaModal(id) {
    $.get('/candidates/'+id).done((res) => {
        $('#modal-visa').modal('show');
        $('#modal-visa form').attr('action', '{{ route('visa.update') }}');
        $('#modal-visa [name=id]').val(res.id);
        $('#modal-visa [name=visa_status]').val(res.visa_status);
        $('#modal-visa [name=visa_date]').val(res.visa_date);
        $('#modal-visa [name=visa_notes]').val(res.visa_notes);
        $('#modal-visa .modal-title').text('Visa Processing - ' + res.full_name);
    });
}

$('#form-visa').on('submit', function(e) {
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize())
    .done(() => {
        $('#modal-visa').modal('hide');
        table.ajax.reload();
        toastr.success('Visa status updated');
    })
    .fail(() => toastr.error('Update failed'));
});
</script>
@endpush