
@include('layouts/head')
@include('layouts/foot')
@include('layouts/sidebar')


<!DOCTYPE html>
<html lang="en">

<head>
    @yield('head')
</head>

<body id="page-top">
    <div id="wrapper">
        @yield('sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ strtoupper(Session::get('nama')) }}</span>
                                <img class="img-profile rounded-circle" src="{{ URL::asset('img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('ganti.password') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ganti Password
                                </a>
                                <a class="dropdown-item" href="#" id="adminbtnlogout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                @yield('content')
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; DKRH 2023</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @yield('foot')
    
    <script>
        @yield('scripts')
        
        $(document).on('click','#adminbtnlogout',function (){
            Swal.fire({
                title: 'Apakah Yakin mau Logout?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Logout!'
            }).then((result) => {
                if (result.isConfirmed)
                {
                    window.location.href = "{{ route('logout') }}";
                }
            });
        });
    </script>
</body>

</html>
