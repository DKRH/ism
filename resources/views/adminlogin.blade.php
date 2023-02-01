<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <link href="{{ URL::asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ URL::asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Masuk Sebagai Admin</h1>
                                    </div>
                                    <form class="user" id="ModalForm">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="nip" placeholder="NIP" name="nip">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password">
                                        </div>
                                        <button id="btnlogin" type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ URL::asset('js/sweetalert2.all.min.js') }}"></script>
    <script>
        $('#ModalForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type : 'POST',
                url: "{{ route('login.validation') }}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) =>
                {
                    if (data.status == 'sukses') {
                        window.location.href = "{{ route('dashboard') }}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data.text,
                        });
                    }
                },
            });
        });
    </script>
</body>
</html>