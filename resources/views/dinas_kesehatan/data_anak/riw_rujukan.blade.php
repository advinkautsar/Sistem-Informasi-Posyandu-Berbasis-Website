@extends('layouts-admin.master')
@section('title 1')
Riwayat Rujukan Anak
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
            <p class="form-text mb-2">Berikut ini merupakan data seluruh riwayat rujukan pada anak terpilih.
            </p>

            <div class="table-responsive">
                <table id="example" class="display nowrap">
                    <thead>
                        <tr>
                            <th style="text-align:center; font-size: 12px;">No.</th>
                            <th style="text-align:center; font-size: 12px;">Nama Anak</th>
                            <th style="text-align:center; font-size: 12px;">Bidan Pemeriksa</th>
                            <th style="text-align:center; font-size: 12px;">Puskesmas Rujukan</th>
                            <th style="text-align:center; font-size: 12px;">Keluhan</th>
                            <th style="text-align:center; font-size: 12px;">Tanggal Rujuk</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_anak as $i=>$row)
                        <tr>
                            <td class="text-center" style="font-size: 12px;">{{++$i}}</td>
                            <td style="text-align:center; font-size: 12px;">{{$row->nama_anak}}</td>
                            <td style="text-align:center; font-size: 12px;">{{$row->nama_bidan}}</td>
                            <td style="text-align:center; font-size: 12px;">{{$row->nama_puskesmas}}</td>
                            <td style="text-align:center; font-size: 12px;">{{$row->keluhan_anak}}</td>
                            <td style="text-align:center; font-size: 12px;">{{$row->tanggal_rujukan}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            <a href="{{route('data_anak_dinkes')}}" class="btn btn-light btn-sm me-2 mt-3 mb-2"><i class="me-2 ti-arrow-left"></i>Kembali</a>
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