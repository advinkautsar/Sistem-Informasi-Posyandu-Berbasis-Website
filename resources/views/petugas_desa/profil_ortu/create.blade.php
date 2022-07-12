@extends('layouts-admin.master')
@section('title 1')
Formulir Daftar Akun Orangtua Baru
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('arfa/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('arfa/assets/css/bootstrap-override.css')}}">
<link rel="stylesheet" href="{{asset('arfa/vendor/izitoast/dist/css/iziToast.min.css')}}">
@endpush
@section('content')

<div class="col-md-12">
    <div class="title fw-bold mt-2 mb-3" style="font-size: 20px;">
        Pengelolaan Profil Orangtua
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
            <form action="{{route('kelola_ortu.store')}}" method="POST" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate="" autocomplete="off">

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
                            <option value="orangtua" selected>Orangtua</option>
                        </select>
                        <span class="text-danger">@error('role'){{ $message }} @enderror</span>
                    </div>


                    <!-- Data Orangtua -->


                    <h6 class="fw-bold mt-5 ">Data Profil Orangtua</h6>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Nama Ibu</label>
                            <input class="form-control" type="text" placeholder="Masukan nama ibu" aria-label="default input example" name="nama_ibu" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                Nama ibu tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">NIK Ibu</label>
                            <input class="form-control" type="number" placeholder="ex : 3510210102450005" aria-label="default input example" name="nik_ibu" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                NIK ibu tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Pendidikan Terakhir Ibu</label>
                            <select class="form-select" name="pendidikan_terakhir_ibu" aria-label="Default select example">
                                <option value="SMA/SMK">SMA sederajat</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="D4/S1">D4 atau S1</option>
                                <option value="S2">S2</option>
                            </select>
                            <span class="text-danger">@error('pendidikan_terakhir_ibu'){{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Nama Ayah</label>
                            <input class="form-control" type="text" placeholder="Masukan nama ayah" aria-label="default input example" name="nama_ayah" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                Nama ayah tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">NIK Ayah</label>
                            <input class="form-control" type="number" placeholder="ex : 3510210102450005" aria-label="default input example" name="nik_ayah" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                NIK ayah tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Pendidikan Terakhir Ayah</label>
                            <select class="form-select" name="pendidikan_terakhir_ayah" aria-label="Default select example">
                                <option value="SMA/SMK">SMA sederajat</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="D4/S1">D4 atau S1</option>
                                <option value="S2">S2</option>
                            </select>
                            <span class="text-danger">@error('pendidikan_terakhir_ibu'){{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Alamat</label>
                            <input class="form-control" type="text" placeholder="Alamat rumah orangtua" aria-label="default input example" name="alamat" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                Alamat rumah tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">RT</label>
                            <input class="form-control" type="text" placeholder="RT 01" aria-label="default input example" name="rt" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                RT tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">RW</label>
                            <input class="form-control" type="text" placeholder="RW 01" aria-label="default input example" name="rw" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                RW tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Status Ekonomi Orangtua</label>
                            <input class="form-control" type="text" placeholder="status ekonomi keluarga saat ini...." aria-label="default input example" name="status_ekonomi" id="validationCustom01" autofocus>
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
                            <label for="basicInput" class="form-label">Status Persetujuan Terdaftar di Posyandu</label>
                            <select class="form-select" name="status_persetujuan" aria-label="Default select example">
                                <option value="disetujui" selected>Di setujui</option>
                            </select>
                            <span class="text-danger">@error('status_persetujuan'){{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Desa / Kelurahan</label>
                            <select class="form-select" name="desa_kelurahan_id" aria-label="Default select example">
                                @foreach($data_desa as $desa)
                                <option value="{{$desa->id}}">{{$desa->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Data Anak -->

                        <h6 class="fw-bold mt-5 ">Data Anak</h6>

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
                            <input class="form-control" type="floatval" aria-label="default input example" placeholder="ex : 4,5 ( Dalam Kg )" name="berat_lahir" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                Berat lahir anak tidak boleh kosong
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Panjang lahir Anak</label>
                            <input class="form-control" type="floatval" aria-label="default input example" name="panjang_lahir" placeholder="ex : 10 ( Dalam cm )" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                Panjang lahir anak tidak boleh kosong
                            </div>
                        </div>


                        <a href="{{route('kelola_ortu.index')}}" class="btn btn-light btn-sm me-2"><i class="me-2 ti-arrow-left"></i>Kembali</a>

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