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
        Pengelolaan Profil Orangtua
    </div>


    <div class="container">
    <div class="col-md-12">
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
                                <p class="text-muted mb-0">: {{$data_ortu->nama_ibu}}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">NIK Ibu</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0"> : {{$data_ortu->nik_ibu}}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Pendidikan Terakhir Ibu</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">: {{$data_ortu->pendidikan_terakhir_ibu}}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Nama Ayah</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">: {{$data_ortu->nama_ayah}}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">NIK Ayah</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">: {{$data_ortu->nik_ayah}}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Pendidikan Terakhir Ayah</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">: {{$data_ortu->pendidikan_terakhir_ayah}}</p>
                            </div>
                        </div>
                        <hr>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Alamat</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">: {{$data_ortu->alamat}}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Status Perekonomian Keluarga</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">: {{$data_ortu->status_ekonomi}}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">RT</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">: {{$data_ortu->rt}}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">RW</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">: {{$data_ortu->rw}}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Posyandu</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">: {{$data_ortu->nama_posyandu}}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Desa / Kelurahan</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">: {{$data_ortu->nama}}</p>
                            </div>
                        </div>
                        <hr>

                    </div>                     
                </div>

                <!-- Tabel Anak -->


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>@yield('title 1')</h4>
                            </div>

                            <div class="card-body">
                                <a href="" class="btn mb-2 btn-primary btn-sm"><i class="me-2 ti-plus"></i>Tambah Data Anak</a>
                                <p class="form-text mb-2">Berikut ini merupakan data anak yang dimiliki oleh orangtua terpilih.
                                </p>

                                <div class="table-responsive">
                                    <table id="example" class="display nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>NIK Anak</th>
                                                <th>Nama Anak</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal lahir</th>
                                                <th>Status Gizi Terakhir</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data_anak as $i=>$row)
                                            <tr>
                                                <td class="text-center">{{++$i}}</td>
                                                <td>{{$row->nik_anak}}</td>
                                                <td>{{$row->nama_anak}}</td>
                                                <td>{{$row->jenis_kelamin}}</td>
                                                <td>{{$row->tanggal_lahir}}</td>
                                                <td class="text-center"><span class="badge bg-success ">Gizi Baik</span></td>
                                                <td>
                                                    <a href="" class="btn btn-sm mb-2 btn-primary" type="button"><i class="ti-eye"></i></a>
                                                    <form action="" method='post' class="d-inline" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini ?') ">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-sm mb-2 btn-danger">
                                                            <i class="ti-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
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