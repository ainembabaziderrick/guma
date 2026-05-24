@extends('layouts.master')

@section('title')
    Medical Exams
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Medical Exams</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Candidates Medical Status</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Full Name</th>
                            <th>Position Applied</th>
                            <th>Medical Status</th>
                            <th>Medical Date</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('medical.medical-modal')
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
        ajax: '{{ route('medical.data') }}',
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'full_name'},
            {data: 'position_applied'},
            {data: 'medical_status'},
            {data: 'medical_date'},
            {data: 'action', searchable: false, sortable: false}
        ]
    });
});

function openMedicalModal(id) {
    $.get('/candidates/'+id).done((res) => {
        $('#modal-medical').modal('show');
        $('#modal-medical form').attr('action', '{{ route('medical.update') }}');
        $('#modal-medical [name=id]').val(res.id);
        $('#modal-medical [name=medical_status]').val(res.medical_status);
        $('#modal-medical [name=medical_date]').val(res.medical_date);
        $('#modal-medical [name=medical_notes]').val(res.medical_notes);
        $('#modal-medical .modal-title').text('Medical Exam - ' + res.full_name);
    });
}

$('#form-medical').on('submit', function(e) {
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize())
    .done(() => {
        $('#modal-medical').modal('hide');
        table.ajax.reload();
        toastr.success('Medical record updated');
    })
    .fail(() => toastr.error('Update failed'));
});
</script>
@endpush