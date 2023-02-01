@extends('layouts/admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">List Peserta</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a class="btn btn-info" href="{{ url("list-rapat") }}">Kembali</a>
            <button class="btn btn-primary" id="add">Buat Daftar Rapat Baru</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="users-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
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
                        <input type="hidden" name="idrapat" id="idrapat">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama" maxlength="50" required="">
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
        var idrapat = {{ $idrapat }};
        url = "{{ route('list-peserta.index', ':idrapat') }}";
        url = url.replace(':idrapat', idrapat);
        console.log(url);
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nama', name: 'nama' },
                { data: 'action', name: 'action' },
            ]
        });

        $(document).on('click','#add',function () {
            $('#xmodal').trigger("reset");
            $('#xmodal_title').html("Tambah Data");
            $('#xmodal').modal('show');
            $('#id').val('');
            $('#idrapat').val('{{ $idrapat }}');
        });

        $('#ModalForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var idrapat = {{ $idrapat }};
            url = "{{ route('list-peserta.store', ':idrapat') }}";
            url = url.replace(':idrapat', idrapat);
            $.ajax({
                type : 'POST',
                url: url,
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

        $(document).on('click','.edit',function (){
            var id = $(this).data('id');
            url = "{{ route('list-peserta.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: function(res){
                    $('#xmodal_title').html("Ubah Data");
                    $('#xmodal').modal('show');
                    $('#id').val(res.id);
                    $('#nama').val(res.nama);
                    $('#idrapat').val(res.list_rapat_id);
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
                    url = "{{ route('list-peserta.destroy', ':id') }}";
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
    });
@stop

