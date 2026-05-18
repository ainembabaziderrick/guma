@extends('layouts.master')

@section('title', 'List of Users')

@section('breadcrumb')
    @parent
    <li class="active">List of Users</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="addForm('{{ route('user.store') }}')" class="btn btn-success btn-flat">
                    <i class="fa fa-plus-circle"></i> Add New User
                </button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('user.form') {{-- Your modal --}}
@endsection

@push('scripts')
<script>
let table;

$(function () {
    // Initialize DataTable
    table = $('.table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: '{{ route('user.data') }}',
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'name'},
            {data: 'email'},
            {data: 'aksi', searchable: false, sortable: false},
        ]
    });

    // Handle modal form submission
    $('#modal-form').validator().on('submit', function (e) {
        e.preventDefault();
        let form = $('#modal-form form');
        let url = form.attr('action');
        let method = form.find('[name=_method]').val() || 'POST';

        $.ajax({
            url: url,
            method: 'POST', // Always POST, _method will override for PUT
            data: form.serialize(),
            success: function(response) {
                $('#modal-form').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                if(xhr.status === 422) { // Laravel validation
                    let errors = xhr.responseJSON.errors;
                    let msg = '';
                    $.each(errors, function(key, value) {
                        msg += value[0] + '\n';
                    });
                    alert(msg);
                } else {
                    alert(xhr.responseText || 'Unable to save data');
                }
            }
        });
    });
});

// Open Add Modal
function addForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Add User');
    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('post');
    $('#modal-form #password, #modal-form #password_confirmation').attr('required', true);
    $('#modal-form input[type=checkbox]').prop('checked', false);
}

// Open Edit Modal
function editForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Edit User');
    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('put');
    $('#modal-form #password, #modal-form #password_confirmation').attr('required', false);

    $.get(url)
        .done((response) => {
            $('#modal-form [name=name]').val(response.name);
            $('#modal-form [name=email]').val(response.email);

            $('#modal-form [name=is_sub_admin]').prop('checked', response.level == 5);
            $('#modal-form [name=is_cashier]').prop('checked', response.level == 2);
            $('#modal-form [name=is_supplier]').prop('checked', response.level == 4);
            $('#modal-form [name=is_customer]').prop('checked', response.level == 3);
            $('#modal-form [name=is_online_customer]').prop('checked', response.level == 6);
        })
        .fail(() => alert('Unable to display data'));
}

// Delete User
function deleteData(url) {
    if (confirm('Are you sure you want to delete selected data?')) {
        $.ajax({
            url: url,
            method: 'DELETE',
            data: {_token: $('[name=csrf-token]').attr('content')},
            success: function() { table.ajax.reload(); },
            error: function() { alert('Unable to delete data'); }
        });
    }
}
</script>
@endpush
