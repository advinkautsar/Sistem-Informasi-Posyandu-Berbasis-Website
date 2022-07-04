@extends('layouts-admin.master')
@section('title 1')
Formulir Daftar Data Bidan Baru
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('arfa/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('arfa/assets/css/bootstrap-override.css')}}">
<link rel="stylesheet" href="{{asset('arfa/vendor/izitoast/dist/css/iziToast.min.css')}}">
@endpush
@section('content')

<div class="col-md-12">
    <div class="title fw-bold mt-2 mb-3" style="font-size: 20px;">
        Pengelolaan Data Bidan
    </div>

    <div class="card">
        <div class="card-header">
            <h4>@yield('title 1')</h4>
        </div>

        @if(Session::get('succes'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('succes') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
            <form action="{{route('kelola_bidan.store')}}" method="POST" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate="" autocomplete="off">

                @csrf

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Nama Pengguna</label>
                        <input class="form-control" type="text" placeholder="Masukan nama pengguna" aria-label="default input example" name="nama_pengguna" id="validationCustom01" required autofocus>

                        <div class="invalid-feedback">
                            Nama pengguna tidak boleh kosong
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Password</label>
                        <div class="input-group input-group-join mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
                            <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i class="fa fa-eye"></i>&nbsp</span>

                            <span class="text-danger"></span>
                            <div class="invalid-feedback">
                                Kata sandi tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Nomor Handphone</label>
                        <input class="form-control" type="tel" placeholder="Masukan nomor handphone pengguna" aria-label="default input example" name="no_hp" id="validationCustom01">
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Role</label>
                        <select class="form-select" name="role" aria-label="Default select example">
                            <option value="bidan" selected>Bidan</option>
                        </select>
                        <span class="text-danger">@error('role'){{ $message }} @enderror</span>
                    </div>

                    <h6 class="fw-bold mt-5 ">Data Profil Bidan</h6>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Nama Bidan</label>
                            <input class="form-control" type="text" placeholder="Masukan nama bidan" aria-label="default input example" name="nama_bidan" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                Nama bidan tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Alamat</label>
                            <input class="form-control" type="text" placeholder="Alamat rumah bidan" aria-label="default input example" name="alamat" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                Alamat rumah bidan tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Posyandu</label>
                            <select class="form-select" name="posyandu_id" aria-label="Default select example">
                                @foreach($data_pos as $pos)
                                <option value="{{$pos->id}}">{{$pos->nama_posyandu}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Berada di wilayah kerja puskesmas</label>
                            <select class="form-select" name="puskesmas_id" aria-label="Default select example">
                                @foreach($data_pus as $pus)
                                <option value="{{$pus->id}}">{{$pus->nama_puskesmas}}</option>
                                @endforeach
                            </select>
                        </div>

                        <a href="{{route('kelola_bidan.index')}}" class="btn btn-light btn-sm me-2"><i class="me-2 ti-arrow-left"></i>Kembali</a>

                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="me-2 ti-save"></i> Simpan
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