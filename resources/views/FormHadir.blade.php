
@extends('layouts/public')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-6"></div>
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card o-hidden border-0">
                <div class="card-body p-0" style="height: 100vh">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <ul class="tabs">
                                <li role="presentation" class="active"><b id="klik1">Umum</b></li>
                                <li role="presentation"><b id="klik2">Anggota DPRD</b></li>
                                <li role="presentation"><b id="klik3">Perangkat Desa</b></li>
                            </ul>
                            <div class="p-5" style="padding-bottom:0px!important;">
                                <hr/>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Detail Rapat</h1>
                                </div>
                                <table class="table table-hovered">
                                    <tr>
                                        <td>Judul</td>
                                        <td>:</td>
                                        <td>{{ $dataRapat->judul_rapat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td>{{ $dataRapat->tanggal_rapat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Hadir</td>
                                        <td>:</td>
                                        <td id="jumlahhadirhtml"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="p-5">
                                <hr/>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Buku Kehadiran</h1>
                                </div>
                                <form class="user" id="ModalForm">
                                    @csrf
                                    <input type="hidden" id="rapat_id" name="rapat_id" value="{{ $dataRapat->id }}"/>
                                    <input type="hidden" id="type" name="tipedata"/>
                                    <input type="hidden" id="id" name="id"/>
                                    <div id="cariGroup">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="cariInput" placeholder="Masukkan Nama Untuk dicari" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" id="cariBtn">Cari</button>
                                            </div>
                                        </div>
                                        <table id="cariHasil" class="table">
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email" placeholder="Masukkan Email" name="email" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="status" placeholder="Masukkan Status" name="status" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="jabatan" placeholder="Masukkan Jabatan" name="jabatan" autocomplete="off">
                                    </div>
                                    <button id="btnsimpan" type="submit" class="btn btn-primary btn-block">
                                        Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#ModalForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type : 'POST',
            url: "{{ route('formHadirCheckin') }}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) =>
            {
                $('#id').val('');
                $('#nama').val('');
                $('#email').val('');
                $('#status').val('');
                $('#jabatan').val('');
                $('#cariInput').val('');
                $('#cariHasil').html('');
                jumlahhadirhitung();
                if (data.status == 'sukses') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sudah TerLog',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.text,
                    });
                }
            },
        });
    });
    function klikerrr(i1,i2,i3,i4='') {
        $('#klik1').parent().removeClass('active');
        $('#klik2').parent().removeClass('active');
        $('#klik3').parent().removeClass('active');
        $(i1).parent().addClass('active');
        $('#email').show();
        $('#status').show();
        $('#jabatan').show();
        $('#cariGroup').hide();
        $('#nama').attr("readonly", false); 
        $('#jabatan').attr("readonly", false);
        $('#id').val('');
        $('#nama').val('');
        $('#email').val('');
        $('#status').val('');
        $('#jabatan').val('');
        $('#cariInput').val('');
        $('#cariHasil').html('');
        $(i2).hide();
        $(i4).hide();
        $('#type').val(i3);
    }
    $('#klik1').click(function() {
        klikerrr('#klik1', '#jabatan', 'umum');
    });
    $('#klik2').click(function() {
        klikerrr('#klik2', '#status', 'dprd', '#email');
        $('#cariGroup').show();
        $('#nama').attr("readonly", true); 
        $('#jabatan').attr("readonly", true);
    });
    $('#klik3').click(function() {
        klikerrr('#klik3', '#status', 'desa', '#email');
    });
    klikerrr('#klik1', '#jabatan', 'umum');
    
    $('#cariBtn').click(function() {
        let text = $('#cariInput').val();
        $.ajax({
            type : 'POST',
            url: "{{ route('formHadirSearch') }}",
            data: {'text':text},
            success: (data) =>
            {
                if (data.kode == 'sukses') {
                    $('#cariHasil').html(data.msg);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.msg,
                    });
                }
            },
        });
    });
    $(document).on('click','.btnPilih',function() {
        let a0 = $(this).data('id');
        let a1 = $(this).data('nama');
        let a2 = $(this).data('jabatan');
        $('#id').val(a0);
        $('#nama').val(a1);
        $('#jabatan').val(a2);
    });
    function jumlahhadirhitung() {
        let id = $('#rapat_id').val();
        $.ajax({
            type : 'POST',
            url: "{{ route('formHadirHitung') }}",
            data: {'id':id},
            success: (data) =>
            {
                $('#jumlahhadirhtml').text(data);
            },
        });
    }
    jumlahhadirhitung();

@endsection