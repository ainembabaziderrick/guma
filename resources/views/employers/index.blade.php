@extends('layouts.master')

@section('title')
    Employer List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Employer List</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('employers.store') }}')" class="btn btn-success btn-flat">
                        <i class="fa fa-plus-circle"></i> Add New Employer
                    </button>
                    <button onclick="deleteSelected('{{ route('employers.delete_selected') }}')" class="btn btn-danger btn-flat">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-employer">
                    @csrf
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="5%">#</th>
                                <th>Company Name</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>City</th>
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

@includeIf('employers.form')
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
                url: '{{ route('employers.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'company_name'},
                {data: 'contact_person'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'country'},
                {data: 'city'},
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
    $('#modal-form') .modal('show');
    $('#modal-form .modal-title').text('Add Employer'); 
    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('post');
    $('#modal-form [name=company_name]').focus();
}

function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Employer');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_produk]').focus();

        $.get(url)
            .done((response) => {
                 $('#modal-form [name=company_name]').val(response.company_name);
        $('#modal-form [name=contact_person]').val(response.contact_person);
        $('#modal-form [name=email]').val(response.email);
        $('#modal-form [name=phone]').val(response.phone);
        $('#modal-form [name=country]').val(response.country);
        $('#modal-form [name=city]').val(response.city);
        $('#modal-form [name=address]').val(response.address);
        $('#modal-form [name=status]').val(response.status);
            })
            .fail((errors) => {
                alert('Unable to display data');
                return;
            });
    }

    function deleteData(url) {
        if (confirm('Are you sure you want to delete this employer?')) {
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
            if (confirm('Are you sure you want to delete selected employers?')) {
                $.post(url, $('.form-employer').serialize())
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