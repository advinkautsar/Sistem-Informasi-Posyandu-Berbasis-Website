@extends('layouts-admin.master')
@section('title 1')
Formulir Daftar Posyandu Baru
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('arfa/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('arfa/assets/css/bootstrap-override.css')}}">
<link rel="stylesheet" href="{{asset('arfa/vendor/izitoast/dist/css/iziToast.min.css')}}">
@endpush
@section('content')

<div class="col-md-12">
    <div class="title fw-bold mt-2 mb-3" style="font-size: 20px;">
        Pengelolaan Data Posyandu
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
            <form action="{{route('kelola_posyandu.store')}}" method="POST" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate="" autocomplete="off">

                @csrf

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Nama Posyandu</label>
                        <input class="form-control" type="text" placeholder="Masukan nama posyandu" aria-label="default input example" name="nama_posyandu" id="validationCustom01" required autofocus>

                        <div class="invalid-feedback">
                            Nama posyandu tidak boleh kosong
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Alamat</label>
                        <input class="form-control" type="text" placeholder="Alamat posyandu" aria-label="default input example" name="alamat" id="validationCustom01" required autofocus>

                        <div class="invalid-feedback">
                            Alamat Posyandu tidak boleh kosong
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Desa atau Kelurahan</label>
                        <select class="form-select" name="desa_kelurahan_id" aria-label="Default select example">
                            @foreach($data_desa as $desa)
                            <option value="{{$desa->id}}">{{$desa->nama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Hari Kegiatan Posyandu</label>
                        <input class="form-control" type="text" placeholder="Hari kegiatan posyandu berlangsung" aria-label="default input example" name="hari_kegiatan" id="validationCustom01" required autofocus>

                        <div class="invalid-feedback">
                            Hari kegiatan posyandu tidak boleh kosong
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Minggu Kegiatan</label>
                        <select class="form-select" name="minggu_kegiatan" aria-label="Default select example">
                            <option value="Minggu-1" >Minggu 1</option>
                            <option value="Minggu-2" >Minggu 2</option>
                            <option value="Minggu-3" >Minggu 3</option>
                            <option value="Minggu-4" >Minggu 4</option>
                        </select>
                        <span class="text-danger">@error('minggu_kegiatan'){{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Puskesmas rujuka posyandu</label>
                        <select class="form-select" name="puskesmas_id" aria-label="Default select example">
                            @foreach($data_pus as $pus)
                            <option value="{{$pus->id}}">{{$pus->nama_puskesmas}}</option>
                            @endforeach
                        </select>
                    </div>

                    <a href="{{route('kelola_posyandu.index')}}" class="btn btn-light btn-sm me-2"><i class="me-2 ti-arrow-left"></i>Kembali</a>

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