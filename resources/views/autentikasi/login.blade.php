<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />


    <link rel="stylesheet" href="{{asset('arfa/vendor/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('arfa/assets/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('arfa/assets/css/bootstrap-override.css')}}">


</head>

<body>
<section class="container h-100">
    <div class="row justify-content-sm-center h-100 align-items-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <h1 class="fs-4 text-center fw-bold mb-4">Login</h1>
                    @if(session()->has('message'))

				<div class=" toastrDefaultSuccess" role="alert" id="notif">
					<!-- 
					<span data-notify="icon" class="fa fa-bell"></span>
					<span data-notify="title">Success</span> <br>
					<span data-notify="message">{{session()->get('message')}}</span> -->
				</div>
				@endif

				@if(session()->has('message_lupapassword'))

				<div class=" toastrDefaultSuccess2" role="alert" id="notif">
					<!-- 
	<span data-notify="icon" class="fa fa-bell"></span>
	<span data-notify="title">Success</span> <br>
	<span data-notify="message">{{session()->get('message')}}</span> -->
				</div>
				@endif

				@if(session()->has('error'))
				<div class="alert alert-danger" role="alert" id="notif">

					<span data-notify="icon" class="fa fa-bell"></span>
					<span data-notify="title">Gagal</span> <br>
					<span data-notify="message">{{session()->get('error')}}</span>
				</div>
				@endif
				@if ($errors->any())
				<div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
					<strong>Gagal !</strong>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
                    
                    <form action="{{ route('postlogin') }}" method="POST" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate=""autocomplete="off">


                        @csrf
                        <div class="mb-3">
                            <label class="mb-2 text-muted fw-bold " for="email">Nama Pengguna</label>
                            <div class="input-group input-group-join mb-3">
                                <input type="text" class="form-control" id="nama_pengguna" placeholder="Masukkan nama pengguna" name="nama_pengguna" id="validationCustom01" required autofocus>                               
                                <span class="input-group-text rounded-end">&nbsp<i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp</span>
                                <div class="invalid-feedback">
                                    Nama pengguna tidak boleh kosong
                                </div>
                           
                                
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-2 w-100">
                                <label class="text-muted fw-bold" for="password">Kata Sandi</label>
                            </div>
                            <div class="input-group input-group-join mb-3">

                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>

                                
                                <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i class="fa fa-eye"></i>&nbsp</span>

                                <span class="text-danger"></span>
                                <div class="invalid-feedback">
                                    Kata sandi tidak boleh kosong
                                </div>

                            </div>
                        </div>

                        <div class="mt-4 d-grid gap-2 ">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>

                    
            </div>
            
        </div>
    </div>
</section>
<script src="{{asset('arfa/assets/js/login.js')}}"></script>
<script src="{{asset('arfa/plugins/toastr/toastr.min.js')}}"></script>
	<script>
		$(function() {


			//   toastr.success('Berhasil Mendaftar akun')

			$('.toastrDefaultSuccess').addClass(function() {

				toastr.success('Berhasil Mendaftar akun. Silahkan login')
			});

			$('.toastrDefaultSuccess2').addClass(function() {

				toastr.success('Berhasil Merubah Password. Silahkan login')
			});


		});
	</script>
</body>
</html>