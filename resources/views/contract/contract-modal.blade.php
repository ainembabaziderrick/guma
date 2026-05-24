<div class="modal fade" id="modal-contract" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="form-contract" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Contract Status</label>
                        <select name="contract_status" class="form-control" required>
                            <option value="not_generated">Not Generated</option>
                            <option value="sent">Sent</option>
                            <option value="signed">Signed</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contract Date</label>
                        <input type="date" name="contract_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Upload Contract File</label>
                        <input type="file" name="contract_file" class="form-control" accept=".pdf,.docx">
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="contract_notes" class="form-control" rows="3"></textarea>
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