@extends('layouts-admin.master')
@section('title 1')
Data Anak
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('arfa/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('arfa/assets/css/bootstrap-override.css')}}">
<link rel="stylesheet" href="{{asset('arfa/vendor/izitoast/dist/css/iziToast.min.css')}}">
@endpush
@section('content')

<div class="col-md-12">
    <div class="title fw-bold mt-2 mb-3" style="font-size: 20px;">
        Data Anak Banyuwangi
    </div>


    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mt-3">
                    <h4> Profil Anak</h4>
                </div>

                <div class="card-body mt-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">Nama Anak</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">: {{$data_anak->nama_anak}}</p>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">NIK Anak</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0"> : {{$data_anak->nik_anak}}</p>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">Tanggal Lahir</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">: {{$data_anak->tanggal_lahir}}</p>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">Jenis Kelamin</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">: {{$data_anak->jenis_kelamin}}</p>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">Berat Badan saat lahir</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">: {{$data_anak->berat_lahir}}</p>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">Tinggi badan saat lahir</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">: {{$data_anak->panjang_lahir}}</p>
                        </div>
                    </div>
                    <hr>

                </div>
            </div>

            <div class="card">
                        <div class="card-header mt-3">
                            <h4> Profil Orangtua</h4>
                        </div>

                        <div class="card-body mt-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Nama Ibu</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">: {{$data_anak->nama_ibu}}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">NIK Ibu</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0"> : {{$data_anak->nik_ibu}}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Pendidikan Terakhir Ibu</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">: {{$data_anak->pendidikan_terakhir_ibu}}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Nama Ayah</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">: {{$data_anak->nama_ayah}}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">NIK Ayah</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">: {{$data_anak->nik_ayah}}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Pendidikan Terakhir Ayah</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">: {{$data_anak->pendidikan_terakhir_ayah}}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Alamat</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">: {{$data_anak->alamat}}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Status Perekonomian Keluarga</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">: {{$data_anak->status_ekonomi}}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">RT</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">: {{$data_anak->rt}}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">RW</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">: {{$data_anak->rw}}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Desa / Kelurahan</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">: {{$data_anak->nama}}</p>
                                </div>
                            </div>
                            <hr>

                            <a href="{{route('data_anak')}}" class="btn btn-light btn-sm me-2"><i class="me-2 ti-arrow-left"></i>Kembali</a>

                        </div>
                    </div>





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