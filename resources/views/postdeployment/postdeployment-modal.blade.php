<div class="modal fade" id="modal-postdeployment" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="form-postdeployment" method="post">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="post_deployment_status" class="form-control" required>
                            <option value="not_started">Not Started</option>
                            <option value="in_probation">In Probation</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="terminated">Terminated</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Probation End Date</label>
                        <input type="date" name="probation_end_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Last Followup Date</label>
                        <input type="date" name="last_followup_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="post_deployment_notes" class="form-control" rows="3" placeholder="Performance, issues, feedback"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>