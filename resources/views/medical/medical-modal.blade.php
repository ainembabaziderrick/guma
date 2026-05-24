<div class="modal fade" id="modal-medical" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="form-medical" method="post">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Medical Status</label>
                        <select name="medical_status" class="form-control" required>
                            <option value="not_scheduled">Not Scheduled</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="passed">Passed</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Medical Date</label>
                        <input type="date" name="medical_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="medical_notes" class="form-control" rows="3"></textarea>
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