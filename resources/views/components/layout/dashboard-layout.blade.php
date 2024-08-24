<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/css/toastify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.css') }}">
    <link href='{{asset('assets/css/dataTables.min.css')}}' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('assets/css/dashbord.css')}}">


    <script src="{{ asset('assets/js/toastify-js.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="text-gray-800 font-inter">

<div id="loder" class="loder !hidden">
    <div class="loderInner">
        <div class="proggerBar"></div>
    </div>
</div>

    <x-Dashboard.dashbord-sidenav />

<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main">

    <x-Dashboard.dashboard-header />

    {{ $slot }}

</main>

<script src="{{asset('assets/js/dashbord.js')}}"></script>
</body>
</html>
