@extends('layouts.master')

@section('title')
    Candidate List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Candidate List</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('candidates.store') }}')" class="btn btn-success btn-flat">
                        <i class="fa fa-plus-circle"></i> Add New Candidate
                    </button>
                    <button onclick="deleteSelected('{{ route('candidates.delete_selected') }}')" class="btn btn-danger btn-flat">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-candidate">
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
                                <th>Region</th>
                                <th>Position Applied</th>
                                <th>Status</th>
                                <th>Date Applied</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@includeIf('candidates.form')
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
                url: '{{ route('candidates.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'full_name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'region'},
                {data: 'position_applied'},
                {data: 'status'},
                {data: 'date_applied'},
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
        $('#modal-form.modal-title').text('Add Candidate'); // <- space here
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=full_name]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form.modal-title').text('Edit Candidate'); // <- space here

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=full_name]').focus();

        $.get(url)
      .done((response) => {
            $('#modal-form [name=full_name]').val(response.full_name);
            $('#modal-form [name=email]').val(response.email);
            $('#modal-form [name=phone]').val(response.phone);
            $('#modal-form [name=region]').val(response.region);
            $('#modal-form [name=position_applied]').val(response.position_applied);
            $('#modal-form [name=status]').val(response.status);
            $('#modal-form [name=date_applied]').val(response.date_applied);
            $('#modal-form [name=remarks]').val(response.remarks);
        })
      .fail(() => {
            alert('Unable to display data');
        });
    }

    function deleteData(url) {
        if (confirm('Are you sure you want to delete this candidate?')) {
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
            if (confirm('Are you sure you want to delete selected candidates?')) {
                $.post(url, $('.form-candidate').serialize())
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