<div class="modal fade" id="modal-payment" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="form-payment" method="post">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Payment</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Candidate</label>
                        <select name="candidate_id" class="form-control" required>
                            <option value="">Select Candidate</option>
                            @foreach(\App\Models\Candidate::orderBy('full_name')->get() as $c)
                                <option value="{{ $c->id }}">{{ $c->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Type</label>
                        <select name="type" class="form-control" required>
                            <option value="processing_fee">Processing Fee</option>
                            <option value="visa_fee">Visa Fee</option>
                            <option value="ticket_fee">Ticket Fee</option>
                            <option value="service_fee">Service Fee</option>
                            <option value="refund">Refund</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" step="0.01" name="amount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                            <option value="failed">Failed</option>
                            <option value="refunded">Refunded</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <input type="text" name="payment_method" class="form-control" placeholder="Bank Transfer, Cash">
                    </div>
                    <div class="form-group">
                        <label>Reference No.</label>
                        <input type="text" name="reference_no" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Payment Date</label>
                        <input type="date" name="payment_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="notes" class="form-control" rows="2"></textarea>
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