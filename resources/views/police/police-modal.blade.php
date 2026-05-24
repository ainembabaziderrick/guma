<div class="modal fade" id="modal-police" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="form-police" method="post">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Clearance Status</label>
                        <select name="police_status" class="form-control" required>
                            <option value="not_submitted">Not Submitted</option>
                            <option value="submitted">Submitted</option>
                            <option value="cleared">Cleared</option>
                            <option value="flagged">Flagged</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="police_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="police_notes" class="form-control" rows="3"></textarea>
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