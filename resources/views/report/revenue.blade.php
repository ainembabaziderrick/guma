@extends('layouts.master')

@section('title')
    Revenue Report
@endsection

@section('content')
<div class="row">
    <!-- Summary Boxes -->
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3 id="invoiced">$0</h3>
                <p>Total Invoiced</p>
            </div>
            <div class="icon"><i class="fa fa-file-invoice-o"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3 id="collected">$0</h3>
                <p>Collected</p>
            </div>
            <div class="icon"><i class="fa fa-money"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 id="pending">$0</h3>
                <p>Pending</p>
            </div>
            <div class="icon"><i class="fa fa-clock-o"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3 id="collection-rate">0%</h3>
                <p>Collection Rate</p>
            </div>
            <div class="icon"><i class="fa fa-percent"></i></div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Filters -->
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <form id="filter-form" class="form-inline">
                    <div class="form-group">
                        <label>Status:</label>
                        <select name="status" class="form-control input-sm">
                            <option value="">All</option>
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            <option value="failed">Failed</option>
                            <option value="refunded">Refunded</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type:</label>
                        <select name="type" class="form-control input-sm">
                            <option value="">All</option>
                            <option value="processing_fee">Processing Fee</option>
                            <option value="visa_fee">Visa Fee</option>
                            <option value="ticket_fee">Ticket Fee</option>
                            <option value="service_fee">Service Fee</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>From:</label>
                        <input type="date" name="from" class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label>To:</label>
                        <input type="date" name="to" class="form-control input-sm">
                    </div>
                    <button type="button" onclick="applyFilter()" class="btn btn-primary btn-sm">Filter</button>
                    <button type="button" onclick="resetFilter()" class="btn btn-default btn-sm">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Charts -->
    <div class="col-md-6">
        <div class="box">
            <div class="box-header"><h3 class="box-title">Revenue by Type</h3></div>
            <div class="box-body">
                <canvas id="typeChart" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header"><h3 class="box-title">Monthly Revenue</h3></div>
            <div class="box-body">
                <canvas id="monthChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Data Table -->
    <div class="col-md-12">
        <div class="box">
            <div class="box-header"><h3 class="box-title">Payment Details</h3></div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Candidate</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Reference</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let table, typeChart, monthChart;

$(function () {
    table = $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('report.revenue.data') }}',
            data: function(d) {
                d.status = $('[name=status]').val();
                d.type = $('[name=type]').val();
                d.from = $('[name=from]').val();
                d.to = $('[name=to]').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'candidate_name'},
            {data: 'type'},
            {data: 'amount'},
            {data: 'payment_method'},
            {data: 'reference_no'},
            {data: 'payment_date'},
            {data: 'status'}
        ]
    });

    loadSummary();
});

function applyFilter() {
    table.ajax.reload();
    loadSummary();
}

function resetFilter() {
    $('#filter-form')[0].reset();
    applyFilter();
}

function loadSummary() {
    $.get('{{ route('report.revenue.summary') }}', $('#filter-form').serialize(), function(res) {
        $('#invoiced').text('$' + res.summary.invoiced.toLocaleString());
        $('#collected').text('$' + res.summary.collected.toLocaleString());
        $('#pending').text('$' + res.summary.pending.toLocaleString());
        $('#collection-rate').text(res.summary.collection_rate + '%');

        // Revenue by Type Chart
        if(typeChart) typeChart.destroy();
        typeChart = new Chart(document.getElementById('typeChart'), {
            type: 'doughnut',
            data: {
                labels: res.by_type.map(x => x.type.replace('_', ')),
                datasets: [{
                    data: res.by_type.map(x => x.total),
                    backgroundColor: ['#3c8dbc', '#00a65a', '#f39c12', '#dd4b39']
                }]
            }
        });

        // Monthly Chart
        if(monthChart) monthChart.destroy();
        monthChart = new Chart(document.getElementById('monthChart'), {
            type: 'line',
            data: {
                labels: res.by_month.map(x => x.month),
                datasets: [{
                    label: 'Revenue',
                    data: res.by_month.map(x => x.total),
                    borderColor: '#00a65a',
                    backgroundColor: 'rgba(0,166,90,0.2)',
                    fill: true
                }]
            }
        });
    });
}
</script>
@endpush