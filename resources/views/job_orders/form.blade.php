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
                        <label for="order_number" class="col-lg-2 col-lg-offset-1 control-label">Order Number</label>
                        <div class="col-lg-6">
                            <input type="text" name="order_number" id="order_number" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="job_title" class="col-lg-2 col-lg-offset-1 control-label">Job Title</label>
                        <div class="col-lg-6">
                            <input type="text" name="job_title" id="job_title" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="employer_id" class="col-lg-2 col-lg-offset-1 control-label">Employer</label>
                        <div class="col-lg-6">
                            <select name="employer_id" id="employer_id" class="form-control" required>
                                <option value="">Select Employer</option>
                                @foreach($employers as $employer)
                                    <option value="{{ $employer->id }}">{{ $employer->company_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="agent_id" class="col-lg-2 col-lg-offset-1 control-label">Agent</label>
                        <div class="col-lg-6">
                            <select name="agent_id" id="agent_id" class="form-control">
                                <option value="">Select Agent</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->agent_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="vacancies" class="col-lg-2 col-lg-offset-1 control-label">Vacancies</label>
                        <div class="col-lg-6">
                            <input type="number" name="vacancies" id="vacancies" class="form-control" value="1" min="1" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="location" class="col-lg-2 col-lg-offset-1 control-label">Location</label>
                        <div class="col-lg-6">
                            <input type="text" name="location" id="location" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="salary" class="col-lg-2 col-lg-offset-1 control-label">Salary</label>
                        <div class="col-lg-6">
                            <input type="number" step="0.01" name="salary" id="salary" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deadline" class="col-lg-2 col-lg-offset-1 control-label">Deadline</label>
                        <div class="col-lg-6">
                            <input type="date" name="deadline" id="deadline" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-lg-2 col-lg-offset-1 control-label">Status</label>
                        <div class="col-lg-6">
                            <select name="status" id="status" class="form-control" required>
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                                <option value="on_hold">On Hold</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-lg-2 col-lg-offset-1 control-label">Description</label>
                        <div class="col-lg-6">
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
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