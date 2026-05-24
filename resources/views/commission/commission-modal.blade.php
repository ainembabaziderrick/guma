<div class="modal fade" id="modal-commission" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="form-commission" method="post">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Commission</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Agent</label>
                        <select name="agent_id" class="form-control" required>
                            <option value="">Select Agent</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <label>Base Amount</label>
                        <input type="number" step="0.01" name="base_amount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Commission Rate %</label>
                        <input type="number" step="0.01" name="commission_rate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Earned Date</label>
                        <input type="date" name="earned_date" class="form-control" required>
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