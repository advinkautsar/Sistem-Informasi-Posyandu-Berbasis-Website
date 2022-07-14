@extends('layouts-admin.master')
@section('title 1')
Formulir Daftar Anak Baru
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('arfa/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('arfa/assets/css/bootstrap-override.css')}}">
<link rel="stylesheet" href="{{asset('arfa/vendor/izitoast/dist/css/iziToast.min.css')}}">
@endpush
@section('content')

<div class="col-md-12">
    <div class="title fw-bold mt-2 mb-3" style="font-size: 20px;">
        Riwayat Pertumbuhan Anak
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
            <form action="{{url('petugas_desa/riwayat_pertumbuhan_anak/store_anak')}}" method="POST" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate="" autocomplete="off">

                @csrf

                <div class="col-md-12">
                    <h6 class="fw-bold mt-2 ">Data Anak</h6>

                    <div class="mb-3">
                        <label for="basicInput" class="form-label">NIK Anak</label>
                        <input class="form-control" type="number" placeholder="ex : 3510210102450005" aria-label="default input example" name="nik_anak" id="validationCustom01" required autofocus>

                        <div class="invalid-feedback">
                            NIK Anak tidak boleh kosong
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Nama Anak</label>
                        <input class="form-control" type="text" placeholder="Masukan nama anak" aria-label="default input example" name="nama_anak" id="validationCustom01" required autofocus>

                        <div class="invalid-feedback">
                            Nama anak tidak boleh kosong
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Jenis Kelamin Anak</label>
                        <select class="form-select" name="jenis_kelamin" aria-label="Default select example">
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <span class="text-danger">@error('jenis_kelamin'){{ $message }} @enderror</span>
                    </div>

                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Tanggal lahir Anak</label>
                        <input class="form-control" type="date" aria-label="default input example" name="tanggal_lahir" id="validationCustom01" required autofocus>

                        <div class="invalid-feedback">
                            Tanggal lahir anak tidak boleh kosong
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Berat lahir Anak</label>
                        <input class="form-control" type="number" step="any" aria-label="default input example" placeholder="ex : 4,5 ( Dalam Kg )" name="berat_lahir" id="validationCustom01"  autofocus>

                        <div class="invalid-feedback">
                            Berat lahir anak tidak boleh kosong
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Panjang lahir Anak</label>
                        <input class="form-control" type="number" step="any" aria-label="default input example" name="panjang_lahir" placeholder="ex : 10 ( Dalam cm )" id="validationCustom01" required autofocus>

                        <div class="invalid-feedback">
                            Panjang lahir anak tidak boleh kosong
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Orangtua</label>
                        <select class="form-select" name="orangtua_id" aria-label="Default select example">
                            @foreach($data_ortu as $ortu)
                            <option value="{{$ortu->id}}">{{$ortu->nama_ibu}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('orangtua_id'){{ $message }} @enderror</span>
                    </div>


                    <a href="{{url('petugas_desa/riwayat_pertumbuhan_anak/index')}}" class="btn btn-light btn-sm me-2"><i class="me-2 ti-arrow-left"></i>Kembali</a>

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