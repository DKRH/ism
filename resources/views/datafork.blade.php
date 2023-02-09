@extends('layouts/admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Forkopinda</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary" id="add">Tambah Data</button>
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
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required="">
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
            ajax: '{!! url('/fork') !!}',
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
            $('#nama').val('');
        });

        $(document).on('click','.edit',function (){
            var id = $(this).data('id');
            url = "{{ route('fork.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: function(res){
                    $('#xmodal_title').html("Ubah Data");
                    $('#xmodal').modal('show');
                    $('#id').val(res.id);
                    $('#nama').val(res.nama);
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
                    url = "{{ route('fork.destroy', ':id') }}";
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
                url: "{{ route('fork.store')}}",
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
    });
@stop

