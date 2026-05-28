@extends('layouts.master')

@section('title')
    Police Clearance
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Police Clearance</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Candidates Police Clearance Documents</h3>
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

@includeIf('police.police-modal')
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
        ajax: '{{ route('police.data') }}',
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

function openPoliceModal(id) {
    $.get('/candidates/'+id).done((res) => {
        $('#modal-police').modal('show');
        $('#modal-police form').attr('action', '{{ route('police.update') }}');
        $('#modal-police [name=id]').val(res.id);
        $('#modal-police [name=police_status]').val(res.police_status);
        $('#modal-police [name=police_date]').val(res.police_date);
        $('#modal-police [name=police_notes]').val(res.police_notes);
        $('#modal-police .modal-title').text('Police Clearance - ' + res.full_name);
    });
}

$('#form-police').on('submit', function(e) {
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize())
    .done(() => {
        $('#modal-police').modal('hide');
        table.ajax.reload();
        toastr.success('Police clearance updated');
    })
    .fail(() => toastr.error('Update failed'));
});
</script>
@endpush