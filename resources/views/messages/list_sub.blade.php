@extends('layouts.master')

@section('title', 'Messages')

@section('breadcrumb')
    @parent
    <li class="active">Messages</li>
@endsection

@section('content')
<div class="pagetitle">
    <h1>Messages</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <!-- wrap table in .table-responsive for horizontal scroll -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Message</th>
                                    <th>Sent At</th>
                                    
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // update unread badge
    function updateUnreadCount() {
        fetch('{{ url('/messages/unread-count') }}')
            .then(res => res.json())
            .then(data => {
                const badge = document.querySelector('#unread-badge');
                if (data.unreadCount > 0) {
                    badge.textContent = data.unreadCount;
                    badge.style.display = 'inline-block';
                } else {
                    badge.style.display = 'none';
                }
            });
    }
    document.addEventListener('DOMContentLoaded', updateUnreadCount);

    $(function () {
        const table = $('.datatable').DataTable({
            responsive: false,  // disable responsive to allow scroll
            scrollX: true,      // enable horizontal scroll
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: '{{ route('messages.data.sub') }}',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name'},
                {data: 'email'},
                {data: 'number'},
                {data: 'message'},
                {data: 'created_at'},
                
            ]
        });

        // delete action
        window.deleteMessage = function (url) {
            if (confirm('Are you sure you want to delete this message?')) {
                $.post(url, {
                    _token: '{{ csrf_token() }}',
                    _method: 'delete'
                })
                .done(() => table.ajax.reload())
                .fail(() => alert('Unable to delete message'));
            }
        }
    });
</script>
@endpush
