@extends('layouts-admin.master')
@section('title 1')
Riwayat Penimbangan dan Status Gizi Anak
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

         
        <div class="card-body">
            <p class="form-text mb-2">Berikut ini merupakan data seluruh riwayat Penimbangan dan status gizi pada anak terpilih.
            </p>

            <div class="table-responsive">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Anak</th>
                            <th>Berat Badan</th>
                            <th>Tinggi Badan</th>
                            <th>Lingkar Kepala</th>
                            <!-- <th style="text-align:center;">Status Gizi Indeks PB_U</th> -->
                            <th style="text-align:center;">Status Gizi Indeks BB_U</th>
                            <th style="text-align:center;">Status Gizi Indeks TB_U</th>
                            <th style="text-align:center;">Status Gizi Indeks LK_U</th>
                            <!-- <th style="text-align:center;">Status Gizi Indeks BB_PB</th> -->
                            <th style="text-align:center;">Status Gizi Indeks BB_TB</th>
                            <th style="text-align:center;">Status Gizi Indeks IMT_U</th>
                            <th>Tanggal Penimbangan</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_anak as $i=>$row)
                        <tr>
                            <td class="text-center">{{++$i}}</td>
                            <td style="text-align:center;">{{$row->nama_anak}}</td>
                            <td style="text-align:center;">{{$row->berat_badan}}</td>
                            <td style="text-align:center;">{{$row->tinggi_badan}}</td>
                            <td style="text-align:center;">{{$row->lingkar_kepala}}</td>
                            <td style="text-align:center;">{{$row->status_bb_u}}</td>
                            <td style="text-align:center;">{{$row->status_tb_u}}</td>
                            <td style="text-align:center;">{{$row->status_lk_u}}</td>
                            <td style="text-align:center;">{{$row->status_bb_tb}}</td>
                            <td style="text-align:center;">{{$row->status_imt_u}}</td> 
                            <td style="text-align:center;">{{\Carbon\Carbon::parse($row->created_at)->format('d M Y')}}</td>        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            <a href="{{route('indexriwayatpertumbuhan')}}" class="btn btn-light btn-sm me-2 mt-3 mb-2"><i class="me-2 ti-arrow-left"></i>Kembali</a>
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