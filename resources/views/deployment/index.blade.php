@extends('layouts.master')

@section('title')
    Deployments
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Deployments</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Candidate Deployments</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Full Name</th>
                            <th>Position Applied</th>
                            <th>Destination</th>
                            <th>Flight No.</th>
                            <th>Departure</th>
                            <th>Arrival</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('deployment.deployment-modal')
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
        ajax: '{{ route('deployment.data') }}',
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'full_name'},
            {data: 'position_applied'},
            {data: 'destination'},
            {data: 'flight_number'},
            {data: 'departure_date'},
            {data: 'arrival_date'},
            {data: 'deployment_status'},
            {data: 'action', searchable: false, sortable: false}
        ]
    });
});

function openDeploymentModal(id) {
    $.get('/candidates/'+id).done((res) => {
        $('#modal-deployment').modal('show');
        $('#modal-deployment form').attr('action', '{{ route('deployment.update') }}');
        $('#modal-deployment [name=id]').val(res.id);
        $('#modal-deployment [name=deployment_status]').val(res.deployment_status);
        $('#modal-deployment [name=departure_date]').val(res.departure_date);
        $('#modal-deployment [name=arrival_date]').val(res.arrival_date);
        $('#modal-deployment [name=flight_number]').val(res.flight_number);
        $('#modal-deployment [name=destination]').val(res.destination);
        $('#modal-deployment [name=deployment_notes]').val(res.deployment_notes);
        $('#modal-deployment .modal-title').text('Deployment - ' + res.full_name);
    });
}

$('#form-deployment').on('submit', function(e) {
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize())
    .done(() => {
        $('#modal-deployment').modal('hide');
        table.ajax.reload();
        toastr.success('Deployment updated');
    })
    .fail(() => toastr.error('Update failed'));
});
</script>
@endpush