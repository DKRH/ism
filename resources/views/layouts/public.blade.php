
@include('layouts/head')
@include('layouts/foot')
@include('layouts/sidebar')


<!DOCTYPE html>
<html lang="en">
<head>
    @yield('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #content {
            overflow: hidden;
            background-image: url({{ URL::asset('img/bg.webp') }});
            background-size: cover;
        }
        .tabs {
            list-style: none;
            margin: 80px 0 0 10px;
            text-align: left;
        }
        .tabs > li {
            float: left;
            display: block;
            padding:2px 10px;
        }
        .tabs > li > b {
            cursor: pointer;
        }
        .active{
            color: white;
            background-color: rgb(154, 154, 255);
            border-radius: 10%;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @yield('content')
            </div>
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
