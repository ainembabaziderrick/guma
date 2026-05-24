@extends('layouts.master')

@section('title')
    Post Deployment
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Post Deployment</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Post Deployment Tracking</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Full Name</th>
                            <th>Position Applied</th>
                            <th>Arrival Date</th>
                            <th>Probation End</th>
                            <th>Last Followup</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('postdeployment.postdeployment-modal')
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
        ajax: '{{ route('postdeployment.data') }}',
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'full_name'},
            {data: 'position_applied'},
            {data: 'arrival_date'},
            {data: 'probation_end_date'},
            {data: 'last_followup_date'},
            {data: 'post_deployment_status'},
            {data: 'action', searchable: false, sortable: false}
        ]
    });
});

function openPostDeploymentModal(id) {
    $.get('/candidates/'+id).done((res) => {
        $('#modal-postdeployment').modal('show');
        $('#modal-postdeployment form').attr('action', '{{ route('postdeployment.update') }}');
        $('#modal-postdeployment [name=id]').val(res.id);
        $('#modal-postdeployment [name=post_deployment_status]').val(res.post_deployment_status);
        $('#modal-postdeployment [name=probation_end_date]').val(res.probation_end_date);
        $('#modal-postdeployment [name=last_followup_date]').val(res.last_followup_date);
        $('#modal-postdeployment [name=post_deployment_notes]').val(res.post_deployment_notes);
        $('#modal-postdeployment .modal-title').text('Post Deployment - ' + res.full_name);
    });
}

$('#form-postdeployment').on('submit', function(e) {
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize())
    .done(() => {
        $('#modal-postdeployment').modal('hide');
        table.ajax.reload();
        toastr.success('Post deployment updated');
    })
    .fail(() => toastr.error('Update failed'));
});
</script>
@endpush