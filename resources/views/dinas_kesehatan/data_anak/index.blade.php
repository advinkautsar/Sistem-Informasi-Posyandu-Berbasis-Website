@extends('layouts-admin.master')
@section('title 1')
Data Kesehatan Seluruh Anak Banyuwangi
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

    <div class="card">
        <div class="card-header">
            <h4>@yield('title 1')</h4>
        </div>

        <div class="card-body">
            
            <p class="form-text mb-2">Berikut ini merupakan data riwayat kesehatan seluruh anak yang terdaftar di Banyuwangi.
            </p>

            <div class="table-responsive">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style="font-size: 12px;">No.</th>
                            <th style="font-size: 12px;">NIK Anak</th>
                            <th style="font-size: 12px;">Nama Anak</th>
                            <th style="font-size: 12px;">Status Gizi Terakhir</th>
                            <th class="text-center" style="font-size: 12px;">Desa</th>
                            <th style="font-size: 12px;">Posyandu</th>
                            <th style="font-size: 12px;">Riwayat Rujukan</th>
                            <th style="font-size: 12px;">Riwayat Pemeriksaan</th>
                            <th style="font-size: 12px;">Riwayat Gizi</th>
                            <th style="font-size: 12px;">Profil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_anak as $i=>$row)
                        <tr>
                            <td class="text-center" style="font-size: 12px;">{{++$i}}</td>
                            <td style="font-size: 12px;">{{$row->nik_anak}}</td>
                            <td style="font-size: 12px;">{{$row->nama_anak}}</td>
                            <td class="text-center" style="font-size: 12px;"><span class="badge bg-success ">Gizi Baik</span></td>
                            <td style="font-size: 12px;">{{$row->nama}}</td>
                            <td style="font-size: 12px;">{{$row->nama_posyandu}}</td>

                            <td class="text-center" style="font-size: 12px;">
                                <a href="{{route('riw_rujukan_dinkes',$row->nik_anak)}}" class="btn btn-sm mb-2 btn-primary" style="font-size: 12px;" type="button">Lihat Riwayat</a>
                            </td>
                            <td class="text-center" style="font-size: 12px;">
                                <a href="{{route('riw_pem_dinkes',$row->nik_anak)}}" class="btn btn-sm mb-2 btn-primary" style="font-size: 12px;" type="button">Lihat Riwayat</a>
                            </td>
                            <td class="text-center" style="font-size: 12px;">
                                <a href="{{route('riw_pen_dinkes',$row->nik_anak)}}" class=" btn btn-sm mb-2 btn-primary " style="font-size: 12px;" type="button">Lihat Riwayat</a>
                            </td>
                            <td>
                                <a href="{{route('profil_anak_dinkes',$row->nik_anak)}}" class="btn btn-sm mb-2 btn-primary" type="button"><i class="ti-eye"></i></a>
                                
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