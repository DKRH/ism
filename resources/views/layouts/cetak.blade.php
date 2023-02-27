
@include('layouts/head')
@include('layouts/foot')

<!DOCTYPE html>
<html lang="en">
<head>
    @yield('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #content {
            overflow: hidden;
            background-image: url({{ URL::asset('img/bg.jpg') }});
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
    @yield('content')
    
    @yield('foot')
</body>
</html>
