<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" href="https://sit.poliwangi.ac.id/favicon.png" type="image/png">
    <title>Sistem Informasi Posyandu Banyuwangi</title>
    <link rel="stylesheet" href="{{asset('public/arfa/vendor/bootstrap/dist/css/bootstrap.min.css')}}">
    <script src="{{asset('public/arfa/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('public/arfa/vendor/chart.js/chart.min.js')}}"></script>

</head>

<body>
    <div class="containter-fluid p-4">
        <div class="row justify-content-md-center">
            <div class="col-md-9 mb-4">
                <h1>Artikel Tips Kesehatan</h1>
            @foreach ($tips as $tip)
            <h3 class="text-center mb-4 mt-4">{{$tip->judul_tips}}</h3>
            <div>{!!$tip->keterangan!!}</div>
            @endforeach
            </div>
        </div>
    </div>

    
</body>

</html>