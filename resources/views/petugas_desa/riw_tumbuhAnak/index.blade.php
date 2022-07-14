@extends('layouts-admin.master')
@section('title 1')
Data Anak di {{auth()->user()->petugas_desa->desa_kelurahan->nama}}
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

        @if(Session::get('berhasil'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('berhasil') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
            <a href="{{url('petugas_desa/riwayat_pertumbuhan_anak/index_tambah')}}" class="btn mb-2 btn-primary btn-sm"><i class="me-2 ti-plus"></i>Daftar Anak Baru</a>
            <p class="form-text mb-2">Berikut ini merupakan data seluruh anak yang terdaftar di wilayah {{auth()->user()->petugas_desa->desa_kelurahan->nama}}
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
                            <th>Riwayat Pemeriksaan</th>
                            <th>Riwayat Penimbangan</th>
                            <th style="text-align:center;">Grafik BB_PB</th>
                            <th style="text-align:center;">Grafik BB_TB</th>
                            <th style="text-align:center;">Grafik PB_U</th>
                            <th style="text-align:center;">Grafik BB_U</th>
                            <th style="text-align:center;">Grafik TB_U</th>
                            <th style="text-align:center;">Grafik LK_U</th>
                            <th style="text-align:center;">Grafik IMT_U</th>
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
                            <td class="text-center">
                                <a href="{{route('riwayat_pemeriksaan',$row->nik_anak)}}" class="btn btn-sm mb-2 btn-primary" type="button"  >Lihat Riwayat</a>
                            </td>
                            <td class="text-center">
                                <a href="{{route('riwayat_penimbangan',$row->nik_anak)}}" class=" btn btn-sm mb-2 btn-primary " type="button" >Lihat Riwayat</a>
                            </td>
                            <td style="text-align:center;">
                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                            </td>
                            <td style="text-align:center;">
                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                            </td>

                            <td style="text-align:center;">
                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                            </td>
                            <td style="text-align:center;">
                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                            </td>
                            <td style="text-align:center;">
                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                            </td>
                            <td style="text-align:center;">
                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                            </td>
                            <td style="text-align:center;">
                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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