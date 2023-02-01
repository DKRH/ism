@extends('layouts/admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Rapat</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a class="btn btn-info" href="{{ url("list-rapat") }}">Kembali</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="users-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tipe</th>
                            <th>Nama</th>
                            <th>Jabatan/Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
                

@section('scripts')
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('/list-rapat-detail')."/".$idrapat }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'tipe', name: 'tipe' },
                { data: 'nama', name: 'nama' },
                { data: 'jabatan', name: 'jabatan' },
            ]
        });
    });
@stop

