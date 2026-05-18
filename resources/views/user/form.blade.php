<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add/Edit User</h4>
                </div>

                <div class="modal-body">
                    <!-- Name -->
                    <div class="form-group row">
                        <label class="col-lg-3 control-label">Name</label>
                        <div class="col-lg-8">
                            <input type="text" name="name" class="form-control" required autofocus>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group row">
                        <label class="col-lg-3 control-label">Email</label>
                        <div class="col-lg-8">
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group row">
                        <label class="col-lg-3 control-label">Password</label>
                        <div class="col-lg-8">
                            <input type="password" name="password" class="form-control" minlength="6">
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group row">
                        <label class="col-lg-3 control-label">Confirm Password</label>
                        <div class="col-lg-8">
                            <input type="password" name="password_confirmation" class="form-control" data-match="[name=password]">
                        </div>
                    </div>

                    <!-- Roles -->
                    <div class="form-group row">
                        <label class="col-lg-3 control-label">Roles</label>
                        <div class="col-lg-8">
                            <div class="form-check">
                                <input type="checkbox" name="is_sub_admin" value="1" class="form-check-input"> Sub Admin
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="is_cashier" value="1" class="form-check-input"> Cashier
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="is_supplier" value="1" class="form-check-input"> Supplier
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="is_customer" value="1" class="form-check-input"> Customer
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="is_online_customer" value="1" class="form-check-input"> Online Customer
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-flat">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">
                        <i class="fa fa-arrow-circle-left"></i> Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
