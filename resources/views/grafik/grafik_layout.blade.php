<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik</title>
    <link rel="stylesheet" href="{{asset('public/arfa/vendor/bootstrap/dist/css/bootstrap.min.css')}}">
    <script src="{{asset('public/arfa/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('public/arfa/vendor/chart.js/chart.min.js')}}"></script>

</head>
<body>
    <div class="container px-3 py-3 bg-primary">
        <h6 class="title text-center text-white">Grafik @yield('nama_grafik')</h6>
        <canvas class="bg-white" id="linechart"></canvas>
    </div>
    @yield('content')
</body>
</html>