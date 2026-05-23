<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" name="_method" value="post">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group row">
                        <label for="company_name" class="col-lg-2 col-lg-offset-1 control-label">Company Name</label>
                        <div class="col-lg-6">
                            <input type="text" name="company_name" id="company_name" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact_person" class="col-lg-2 col-lg-offset-1 control-label">Contact Person</label>
                        <div class="col-lg-6">
                            <input type="text" name="contact_person" id="contact_person" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-lg-2 col-lg-offset-1 control-label">Email</label>
                        <div class="col-lg-6">
                            <input type="email" name="email" id="email" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-lg-2 col-lg-offset-1 control-label">Phone</label>
                        <div class="col-lg-6">
                            <input type="text" name="phone" id="phone" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="country" class="col-lg-2 col-lg-offset-1 control-label">Country</label>
                        <div class="col-lg-6">
                            <input type="text" name="country" id="country" class="form-control" value="UAE">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-lg-2 col-lg-offset-1 control-label">City</label>
                        <div class="col-lg-6">
                            <input type="text" name="city" id="city" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-lg-2 col-lg-offset-1 control-label">Address</label>
                        <div class="col-lg-6">
                            <textarea name="address" id="address" class="form-control" rows="3"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-lg-2 col-lg-offset-1 control-label">Status</label>
                        <div class="col-lg-6">
                            <select name="status" id="status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-success">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <button type="button" class="btn btn-sm btn-flat btn-danger" data-dismiss="modal">
                        <i class="fa fa-arrow-circle-left"></i> Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>