@extends('layouts-admin.master')
@section('title 1')
Formulir Edit Data Akun Dinas Kesehatan
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('arfa/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('arfa/assets/css/bootstrap-override.css')}}">
<link rel="stylesheet" href="{{asset('arfa/vendor/izitoast/dist/css/iziToast.min.css')}}">
@endpush
@section('content')

<div class="col-md-12">
    <div class="title fw-bold mt-2 mb-3" style="font-size: 20px;">
        Pengelolaan Data Pengguna
    </div>

    <div class="card">
        <div class="card-header">
            <h4>@yield('title 1')</h4>
        </div>

        <div class="card-body">
            <form action="{{route('dinkes.update',$data_user->id)}}" method="POST" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate="" autocomplete="off">
                @csrf
                @method('PUT')

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Nama Pengguna</label>
                        <input class="form-control" type="text" placeholder="Masukan nama pengguna" aria-label="default input example" name="nama_pengguna" value="{{$data_user->nama_pengguna}}" id="validationCustom01" required autofocus>

                        <div class="invalid-feedback">
                            Nama pengguna tidak boleh kosong
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Password</label>
                        <div class="input-group input-group-join mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi baru">
                            <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i class="fa fa-eye"></i>&nbsp</span>

                            <span class="text-danger"></span>
                            
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Nomor Handphone</label>
                        <input class="form-control" type="tel" placeholder="Masukan nama pengguna" aria-label="default input example" name="no_hp" value="{{$data_user->no_hp}}" id="validationCustom01">
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Role</label>
                        <select class="form-select" name="role" aria-label="Default select example">
                            <option value="dinas_kesehatan" selected>Dinas Kesehatan</option>
                        </select>
                        <span class="text-danger">@error('role'){{ $message }} @enderror</span>
                    </div>

                    <a href="{{route('dinkes.index')}}" class="btn btn-light btn-sm me-2"><i class="me-2 ti-arrow-left"></i>Kembali</a>

                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="me-2 ti-save"></i> Ubah
                    </button>
                    
                </div>
            </form>
        </div>
    </div>

</div>




@endsection
@push('js')
<script src="{{asset('arfa/assets/js/login.js')}}"></script>
<script src="{{asset('arfa/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('arfa/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('arfa/vendor/izitoast/dist/js/iziToast.min.js')}}"></script>
@endpush