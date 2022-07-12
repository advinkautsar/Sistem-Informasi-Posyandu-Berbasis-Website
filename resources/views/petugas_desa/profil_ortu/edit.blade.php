@extends('layouts-admin.master')
@section('title 1')
Formulir Edit Profil Orangtua
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

        <div class="card-body">
            <form action="{{route('kelola_ortu.update', $data_ortu->id)}}" method="POST" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate="" autocomplete="off">

                @csrf
                @method('PUT')

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Nama Pengguna</label>
                        <input class="form-control" type="text" placeholder="Masukan nama pengguna" aria-label="default input example" value="{{$data_ortu->nama_pengguna}}" name="nama_pengguna" id="validationCustom01" required autofocus>

                        <div class="invalid-feedback">
                            Nama pengguna tidak boleh kosong
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Password</label>
                        <div class="input-group input-group-join mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi">
                            <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i class="fa fa-eye"></i>&nbsp</span>


                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basicInput" class="form-label">Nomor Handphone</label>
                        <input class="form-control" type="tel" placeholder="Masukan nomor handphone pengguna" aria-label="default input example" value="{{$data_ortu->no_hp}}" name="no_hp" id="validationCustom01">
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
                            <input class="form-control" type="text" placeholder="Masukan nama ibu" aria-label="default input example" name="nama_ibu" value="{{$data_ortu->nama_ibu}}" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                Nama ibu tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">NIK Ibu</label>
                            <input class="form-control" type="number" placeholder="ex : 3510210102450005" aria-label="default input example" value="{{$data_ortu->nik_ibu}}" name="nik_ibu" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                NIK ibu tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Pendidikan Terakhir Ibu</label>
                            <select class="form-select" name="pendidikan_terakhir_ibu" aria-label="Default select example">
                                <option value="SMA/SMK" {{($data_ortu->pendidikan_terakhir_ibu === 'SMA/SMK') ? 'Selected' : ''}}>SMA sederajat</option>
                                <option value="D1" {{($data_ortu->pendidikan_terakhir_ibu === 'D1') ? 'Selected' : ''}}>D1</option>
                                <option value="D2" {{($data_ortu->pendidikan_terakhir_ibu === 'D2') ? 'Selected' : ''}}>D2</option>
                                <option value="D3" {{($data_ortu->pendidikan_terakhir_ibu === 'D3') ? 'Selected' : ''}}>D3</option>
                                <option value="D4/S1" {{($data_ortu->pendidikan_terakhir_ibu === 'D4/S1') ? 'Selected' : ''}}>D4/S1</option>
                                <option value="S2" {{($data_ortu->pendidikan_terakhir_ibu === 'S2') ? 'Selected' : ''}}>S2</option>
                            </select>
                            <span class="text-danger">@error('pendidikan_terakhir_ibu'){{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Nama Ayah</label>
                            <input class="form-control" type="text" placeholder="Masukan nama ayah" aria-label="default input example" value="{{$data_ortu->nama_ayah}}" name="nama_ayah" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                Nama ayah tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">NIK Ayah</label>
                            <input class="form-control" type="number" placeholder="ex : 3510210102450005" aria-label="default input example" value="{{$data_ortu->nik_ayah}}" name="nik_ayah" id="validationCustom01" required autofocus>

                            <div class="invalid-feedback">
                                NIK ayah tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Pendidikan Terakhir Ayah</label>
                            <select class="form-select" name="pendidikan_terakhir_ayah" aria-label="Default select example">
                                <option value="SMA/SMK" {{($data_ortu->pendidikan_terakhir_ayah === 'SMA/SMK') ? 'Selected' : ''}}>SMA sederajat</option>
                                <option value="D1" {{($data_ortu->pendidikan_terakhir_ayah === 'D1') ? 'Selected' : ''}}>D1</option>
                                <option value="D2" {{($data_ortu->pendidikan_terakhir_ayah === 'D2') ? 'Selected' : ''}}>D2</option>
                                <option value="D3" {{($data_ortu->pendidikan_terakhir_ayah === 'D3') ? 'Selected' : ''}}>D3</option>
                                <option value="D4/S1" {{($data_ortu->pendidikan_terakhir_ayah === 'D4/S1') ? 'Selected' : ''}}>D4/S1</option>
                                <option value="S2" {{($data_ortu->pendidikan_terakhir_ayah === 'S2') ? 'Selected' : ''}}>S2</option>
                            </select>
                            <span class="text-danger">@error('pendidikan_terakhir_ayah'){{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Alamat</label>
                            <input class="form-control" type="text" placeholder="Alamat rumah orangtua" aria-label="default input example" name="alamat" id="validationCustom01" value="{{$data_ortu->alamat}}" required autofocus>

                            <div class="invalid-feedback">
                                Alamat rumah tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">RT</label>
                            <input class="form-control" type="text" placeholder="RT 01" aria-label="default input example" name="rt" id="validationCustom01" value="{{$data_ortu->rt}}" required autofocus>

                            <div class="invalid-feedback">
                                RT tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">RW</label>
                            <input class="form-control" type="text" placeholder="RW 01" aria-label="default input example" name="rw" id="validationCustom01" value="{{$data_ortu->rw}}" required autofocus>

                            <div class="invalid-feedback">
                                RW tidak boleh kosong
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Status Ekonomi Orangtua</label>
                            <input class="form-control" type="text" placeholder="status ekonomi keluarga saat ini...." aria-label="default input example" value="{{$data_ortu->status_ekonomi}}" name="status_ekonomi" id="validationCustom01" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Posyandu</label>
                            <select class="form-select" name="posyandu_id" aria-label="Default select example">
                                @foreach($data_pos as $pos)
                                <option value="{{$pos->id}}" @if($pos->id==$data_ortu->posyandu_id)
                                    selected
                                    @endif
                                    >{{$pos->nama_posyandu}}</option>
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
                                <option value="{{$desa->id}}" @if($desa->id==$data_ortu->desa_kelurahan_id)
                                    selected
                                    @endif
                                    >{{$desa->nama}}</option>
                                @endforeach
                            </select>
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