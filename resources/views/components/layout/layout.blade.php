<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory Managment</title>
    <link rel="stylesheet" href="{{ asset('assets/css/toastify.min.css') }}">

    <script src="{{ asset('assets/js/toastify-js.js') }}"></script>
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

    <div id="loder" class="loder !hidden">
        <div class="loderInner">
            <div class="proggerBar"></div>
        </div>
    </div>



    {{ $slot }}
    

</body>
</html>