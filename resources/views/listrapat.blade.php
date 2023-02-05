@extends('layouts/admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Rapat</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary" id="add">Buat Rapat Baru</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="users-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Kursi</th>
                            <th>Total Peserta</th>
                            <th>Admin</th>
                            <th>Stat Aktif</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="xmodal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:void(0)" id="ModalForm" name="ModalForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="xmodal_title"></h4>
                </div>
                <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="admin_id" id="admin_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-6 control-label">Tanggal</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="tanggal_rapat" name="tanggal_rapat" placeholder="Tanggal Rapat" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Judul</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="judul_rapat" name="judul_rapat" placeholder="Judul" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Deskripsi</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="deskripsi_rapat" name="deskripsi_rapat" placeholder="Deskripsi" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Jumlah Kursi</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="jumlah_kursi" name="jumlah_kursi" placeholder="Jumlah Kursi" required="">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
                

@section('scripts')
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url('/list-rapat') !!}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'tanggal_rapat2', name: 'tanggal_rapat' },
                { data: 'judul_rapat', name: 'judul_rapat' },
                { data: 'deskripsi_rapat', name: 'deskripsi_rapat' },
                { data: 'jumlah_kursi', name: 'jumlah_kursi' },
                { data: 'total', name: 'total' },
                { data: 'admin', name: 'admin' },
                { data: 'stataktif', name: 'stataktif' },
                { data: 'action', name: 'action' },
            ]
        });

        $(document).on('click','#add',function () {
            $('#xmodal').trigger("reset");
            $('#xmodal_title').html("Tambah Data");
            $('#xmodal').modal('show');
            $('#id').val('');
            $('#judul_rapat').val('');
            $('#tanggal_rapat').val('');
            $('#deskripsi_rapat').val('');
            $('#jumlah_kursi').val('');
            $('#admin_id').val('{{ Session::get('id')  }}');
        });

        $(document).on('click','.edit',function (){
            var id = $(this).data('id');
            url = "{{ route('list-rapat.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: function(res){
                    $('#xmodal_title').html("Ubah Data");
                    $('#xmodal').modal('show');
                    $('#id').val(res.id);
                    $('#judul_rapat').val(res.judul_rapat);
                    $('#tanggal_rapat').val(res.tanggal_rapat);
                    $('#deskripsi_rapat').val(res.deskripsi_rapat);
                    $('#jumlah_kursi').val(res.jumlah_kursi);
                    $('#admin_id').val(res.admin_id);
                }
            });
        });

        $(document).on('click','.delete',function (){
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Data tidak akan bisa dikembalikan",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin, Hapus!'
            }).then((result) => {
                if (result.isConfirmed)
                {
                    url = "{{ route('list-rapat.destroy', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type    : 'DELETE',
                        url     : url,
                        data    : {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            Swal.fire({
                                title: "Sukses dihapus!",
                                confirmButtonColor: "#66BB6A",
                            });
                            var oTable = $('#users-table').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                }
            });
        });

        $('#ModalForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type : 'POST',
                url: "{{ route('list-rapat.store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) =>
                {
                    $("#xmodal").modal('hide');
                    var oTable = $('#users-table').dataTable();
                    oTable.fnDraw(false);
                },
                error: function(data)
                {
                    console.log(data);
                }
            });
        });
        

        $(document).on('click','.stataktif_aktivasi',function (){
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Rapat ini akan diaktifkan dan menon-aktifkan rapat lainnya!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin, Hapus!'
            }).then((result) => {
                if (result.isConfirmed)
                {
                    $.ajax({
                        type    : 'POST',
                        url     : "{{ route('list-rapat.stataktif') }}",
                        data    : {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        success: function(data) {
                            var oTable = $('#users-table').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                }
            });
        });
    });
@stop

