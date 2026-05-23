@extends('layouts.master')

@section('title')
    Job Order List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Job Order List</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('job-orders.store') }}')" class="btn btn-success btn-flat">
                        <i class="fa fa-plus-circle"></i> Add New Job Order
                    </button>
                    <button onclick="deleteSelected('{{ route('job_orders.delete_selected') }}')" class="btn btn-danger btn-flat">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-job-order">
                    @csrf
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="5%">#</th>
                                <th>Order No</th>
                                <th>Job Title</th>
                                <th>Employer</th>
                                <th>Agent</th>
                                <th>Vacancies</th>
                                <th>Location</th>
                                <th>Salary</th>
                                <th>Status</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@includeIf('job_orders.form')
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
            ajax: {
                url: '{{ route('job_orders.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'order_number'},
                {data: 'job_title'},
                {data: 'employer_name'},
                {data: 'agent_name'},
                {data: 'vacancies'},
                {data: 'location'},
                {data: 'salary'},
                {data: 'status'},
                {data: 'aksi', searchable: false, sortable: false}
            ]
        });

        $('#modal-form').validator().on('submit', function (e) {
            if (!e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                        toastr.success('Data saved successfully');
                    })
                .fail(() => {
                        toastr.error('Unable to save data');
                    });
            }
        });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form.modal-title').text('Add Job Order');
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=job_title]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form.modal-title').text('Edit Job Order');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');

        $.get(url)
       .done((response) => {
            $('#modal-form [name=order_number]').val(response.order_number);
            $('#modal-form [name=job_title]').val(response.job_title);
            $('#modal-form [name=employer_id]').val(response.employer_id);
            $('#modal-form [name=agent_id]').val(response.agent_id);
            $('#modal-form [name=vacancies]').val(response.vacancies);
            $('#modal-form [name=location]').val(response.location);
            $('#modal-form [name=salary]').val(response.salary);
            $('#modal-form [name=deadline]').val(response.deadline);
            $('#modal-form [name=status]').val(response.status);
            $('#modal-form [name=description]').val(response.description);
        })
       .fail((errors) => {
            alert('Unable to display data');
        });
    }

    function deleteData(url) {
        if (confirm('Are you sure you want to delete this Job Order?')) {
            $.post(url, {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    '_method': 'delete'
                })
            .done(() => {
                    table.ajax.reload();
                    toastr.success('Deleted successfully');
                })
            .fail(() => {
                    toastr.error('Unable to delete data');
                });
        }
    }

    function deleteSelected(url) {
        if ($('input:checked').length > 1) {
            if (confirm('Are you sure you want to delete selected Job Orders?')) {
                $.post(url, $('.form-job-order').serialize())
                .done(() => {
                        table.ajax.reload();
                        toastr.success('Deleted successfully');
                    })
                .fail(() => {
                        toastr.error('Unable to delete data');
                    });
            }
        } else {
            alert('Select the data to delete');
        }
    }
</script>
@endpush