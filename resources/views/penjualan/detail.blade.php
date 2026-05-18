<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="modal-detail">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Sales Details</h4>
            </div>
            <div class="modal-body">
                <!-- Member Name Row -->
                <div class="form-group">
                    <label><strong>Member Name:</strong></label>
                    <input type="text" id="member-name" class="form-control" readonly>
                </div>

                <!-- Sales Details Table -->
                <table class="table table-striped table-bordered table-detail table-hover">
                    <thead>
                        <th width="5%">#</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
