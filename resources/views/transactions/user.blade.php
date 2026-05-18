@extends('layouts.master')

@section('title')
    Daily Transactions
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daily Transactions</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered table-penjualan table-hover">
                <thead>
    <th width="5%">#</th>
    <th>Date</th>
    <th>Quantity</th>
    <th>Total Price</th>
    <th>Discount</th>
    <th>Amount Paid</th> <!-- Updated column name -->
    <th>Cashier</th>
</thead>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- visit "codeastro" for more projects! -->
@includeIf('penjualan.detail')
@endsection

@push('scripts')
<script>
    let table, table1;

    $(function () {
        table = $('.table-penjualan').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('usertransactions.data') }}',
            },
            columns: [
    {data: 'DT_RowIndex', searchable: false, sortable: false},
    {data: 'tanggal'},
    {data: 'total_item'},
    {data: 'total_harga'},
    {data: 'diskon'},
    {data: 'diterima'}, // ✅ This should match backend addColumn('diterima')
    {data: 'kasir'}
]

        });

        table1 = $('.table-detail').DataTable({
            processing: true,
            bSort: false,
            dom: 'Brt',
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_produk'},
                {data: 'nama_produk'},
                {data: 'harga_jual'},
                {data: 'jumlah'},
                {data: 'subtotal'},
            ]
        })
    });

    function showDetail(url, memberName) {
    $('#modal-detail').modal('show');

    // Set the Member Name in the modal
    $('#member-name').val(memberName);

    // Reload sales details table
    table1.ajax.url(url);
    table1.ajax.reload();
}


    function deleteData(url) {
        if (confirm('Are you sure you want to delete selected data?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Unable to delete data');
                    return;
                });
        }
    }
</script>
@endpush
