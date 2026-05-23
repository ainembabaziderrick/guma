@extends('layouts.master')

@section('title')
    Screening & Shortlist
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Screening & Shortlist</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Candidates for Screening</h3>
                <div class="box-tools pull-right">
                    <div class="btn-group">
                        <button onclick="bulkUpdateStatus('shortlisted')" class="btn btn-info btn-flat btn-sm">
                            <i class="fa fa-thumbs-up"></i> Bulk Shortlist
                        </button>
                        <button onclick="bulkUpdateStatus('rejected')" class="btn btn-danger btn-flat btn-sm">
                            <i class="fa fa-times"></i> Bulk Reject
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                <form id="form-screening">
                    @csrf
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="5%">#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Position Applied</th>
                                <th>Status</th>
                                <th>Date Applied</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

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
        autoWidth: false,
        ajax: '{{ route('screening.data') }}',
        columns: [
            {data: 'select_all', searchable: false, sortable: false},
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'full_name'},
            {data: 'email'},
            {data: 'phone'},
            {data: 'position_applied'},
            {data: 'status'},
            {data: 'date_applied'},
            {data: 'action', searchable: false, sortable: false}
        ]
    });

    $('#select_all').on('click', function () {
        $('input[name="id[]"]').prop('checked', this.checked);
    });
});

function updateStatus(id, status) {
    if(confirm('Change status to '+status+'?')) {
        $.post('{{ route('screening.update_status') }}', {
            _token: '{{ csrf_token() }}',
            id: id,
            status: status
        }).done(() => {
            table.ajax.reload();
            toastr.success('Status updated');
        }).fail(() => {
            toastr.error('Failed to update status');
        });
    }
}

function bulkUpdateStatus(status) {
    let ids = $('input[name="id[]"]:checked').map(function(){ return this.value; }).get();
    if(ids.length == 0) {
        alert('Select at least one candidate');
        return;
    }
    if(confirm('Update '+ids.length+' candidates to '+status+'?')) {
        $.post('{{ route('screening.update_status') }}', {
            _token: '{{ csrf_token() }}',
            id: ids,
            status: status
        }).done(() => {
            table.ajax.reload();
            toastr.success('Bulk update success');
        });
    }
}

function viewCandidate(id) {
    $.get('/candidates/'+id).done((res) => {
        $('#modal-view .modal-title').text('Candidate Details'); // <- add space
        $('#modal-view #v_full_name').text(res.full_name);
        $('#modal-view #v_email').text(res.email);
        $('#modal-view #v_phone').text(res.phone);
        $('#modal-view #v_nationality').text(res.nationality); // <- add this
        $('#modal-view #v_position').text(res.position_applied);
        $('#modal-view #v_date_applied').text(res.date_applied); // <- add this
        $('#modal-view #v_status').text(res.status);
        $('#modal-view #v_remarks').text(res.remarks);
        $('#modal-view').modal('show');
    }).fail(() => {
        toastr.error('Unable to load candidate');
    });
}

</script>
@endpush