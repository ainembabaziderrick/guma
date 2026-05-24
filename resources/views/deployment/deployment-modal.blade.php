<div class="modal fade" id="modal-deployment" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="form-deployment" method="post">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Deployment Status</label>
                        <select name="deployment_status" class="form-control" required>
                            <option value="not_scheduled">Not Scheduled</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="departed">Departed</option>
                            <option value="arrived">Arrived</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Destination</label>
                        <input type="text" name="destination" class="form-control" placeholder="Dubai, UAE">
                    </div>
                    <div class="form-group">
                        <label>Flight Number</label>
                        <input type="text" name="flight_number" class="form-control" placeholder="EK123">
                    </div>
                    <div class="form-group">
                        <label>Departure Date</label>
                        <input type="date" name="departure_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Arrival Date</label>
                        <input type="date" name="arrival_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="deployment_notes" class="form-control" rows="3"></textarea>
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