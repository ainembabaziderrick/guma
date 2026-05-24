<div class="modal fade" id="modal-visa" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="form-visa" method="post">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Visa Status</label>
                        <select name="visa_status" class="form-control" required>
                            <option value="not_started">Not Started</option>
                            <option value="submitted">Submitted</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="issued">Issued</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Visa Date</label>
                        <input type="date" name="visa_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="visa_notes" class="form-control" rows="3"></textarea>
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