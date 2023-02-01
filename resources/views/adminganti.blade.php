
@extends('layouts/admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Ganti Password
        </div>
        <div class="card-body">
            <form class="user" id="ModalForm">
                @csrf
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="passwordlama" placeholder="Masukkan Password Lama" name="passwordlama">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="passwordbaru" placeholder="Masukkan Password Baru" name="passwordbaru">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="passwordbaru2" placeholder="Masukkan Lagi Password Baru" name="passwordbaru2">
                </div>
                <button id="btnsimpan" type="submit" class="btn btn-primary btn-user btn-block">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    $('#ModalForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type : 'POST',
            url: "{{ route('ganti.password.simpan') }}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) =>
            {
                $('#passwordlama').val('');
                $('#passwordbaru').val('');
                $('#passwordbaru2').val('');
                if (data.status == 'sukses') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Berhasil Diubah',
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
@endsection