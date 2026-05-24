@extends('layouts.master')

@section('title')
    Deployment Report
@endsection

@section('content')
<div class="row">
    <!-- Summary Boxes -->
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3 id="total-deployed">0</h3>
                <p>Total Deployed</p>
            </div>
            <div class="icon"><i class="fa fa-plane"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 id="scheduled">0</h3>
                <p>Scheduled</p>
            </div>
            <div class="icon"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3 id="departed">0</h3>
                <p>Departed</p>
            </div>
            <div class="icon"><i class="fa fa-send"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3 id="arrived">0</h3>
                <p>Arrived</p>
            </div>
            <div class="icon"><i class="fa fa-check"></i></div>
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
                            <option value="scheduled">Scheduled</option>
                            <option value="departed">Departed</option>
                            <option value="arrived">Arrived</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Destination:</label>
                        <input type="text" name="destination" class="form-control input-sm" placeholder="Dubai">
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
            <div class="box-header"><h3 class="box-title">Top Destinations</h3></div>
            <div class="box-body">
                <canvas id="destinationChart" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header"><h3 class="box-title">Monthly Arrivals</h3></div>
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
            <div class="box-header"><h3 class="box-title">Deployment Details</h3></div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Destination</th>
                            <th>Flight No.</th>
                            <th>Departure</th>
                            <th>Arrival</th>
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
let table;
let destChart, monthChart;

$(function () {
    table = $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('report.deployment.data') }}',
            data: function(d) {
                d.status = $('[name=status]').val();
                d.destination = $('[name=destination]').val();
                d.from = $('[name=from]').val();
                d.to = $('[name=to]').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'full_name'},
            {data: 'destination'},
            {data: 'flight_number'},
            {data: 'departure_date'},
            {data: 'arrival_date'},
            {data: 'deployment_status'}
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
    $.get('{{ route('report.deployment.summary') }}', $('#filter-form').serialize(), function(res) {
        $('#total-deployed').text(res.summary.total);
        $('#scheduled').text(res.summary.scheduled);
        $('#departed').text(res.summary.departed);
        $('#arrived').text(res.summary.arrived);

        // Destination Chart
        if(destChart) destChart.destroy();
        destChart = new Chart(document.getElementById('destinationChart'), {
            type: 'bar',
            data: {
                labels: res.by_destination.map(x => x.destination),
                datasets: [{
                    label: 'Candidates',
                    data: res.by_destination.map(x => x.total),
                    backgroundColor: '#3c8dbc'
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
                    label: 'Arrivals',
                    data: res.by_month.map(x => x.total),
                    borderColor: '#00a65a',
                    fill: false
                }]
            }
        });
    });
}
</script>
@endpush