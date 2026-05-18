<div class="modal fade" id="modal-member" tabindex="-1" role="dialog" aria-labelledby="modal-member">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Select Members</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-member table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Name</th>
                            <th>Telephone</th>
                            <th>Address</th>
                            <th><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($member as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->telepon }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs btn-flat"
                                        onclick="pilihMember('{{ $item->id_member }}', '{{ $item->kode_member }}')">
                                        <i class="fa fa-check-circle"></i> Select
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        // Initialize DataTable for Member Modal
        $('.table-member').DataTable({
            responsive: true,
            searching: true,  // Enable search bar
            paging: true,     // Enable pagination
            ordering: true,   // Enable column sorting
            autoWidth: false
        });
    });

    function tampilMember() {
        $('#modal-member').modal('show');
    }

    function pilihMember(id, kode) {
        $('#id_member').val(id);
        $('#kode_member').val(kode);
        $('#diskon').val('{{ $diskon }}');
        loadForm($('#diskon').val());
        $('#diterima').val(0).focus().select();
        $('#modal-member').modal('hide');
    }
</script>
@endpush
