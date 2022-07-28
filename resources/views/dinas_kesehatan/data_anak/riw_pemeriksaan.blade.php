@extends('layouts-admin.master')
@section('title 1')
Riwayat Pemeriksaan Kesehatan 
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
            <p class="form-text mb-2">Berikut ini merupakan data seluruh riwayat pemeriksaan pada anak terpilih
            </p>

            <div class="table-responsive">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style="font-size: 12px;">No.</th>
                            <th style="font-size: 12px;">Nama Anak</th>
                            <th style="font-size: 12px;">Imunisasi - 1</th>
                            <th style="font-size: 12px;">Imunisasi - 2</th>
                            <th style="font-size: 12px;">Imunisasi - 3</th>
                            <th style="font-size: 12px;">Vit A Merah</th>
                            <th style="font-size: 12px;">Vit A Biru</th>
                            <th style="font-size: 12px;">Fe-1</th>
                            <th style="font-size: 12px;">Fe-2</th>
                            <th style="font-size: 12px;">PMT</th>
                            <th style="font-size: 12px;">Asi Eksklusif</th>
                            <th style="font-size: 12px;">Oralit</th>
                            <th style="font-size: 12px;">Obat Cacing</th>
                            <th style="font-size: 12px;">Tanggal Pemeriksaan</th>
                            <th style="font-size: 12px;">Nama Bidan Pemeriksa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_anak as $i=>$row)
                        <tr>
                            <td class="text-center" style="font-size: 12px;">{{++$i}}</td>
                            <td style="font-size: 12px;">{{$row->nama_anak}}</td>
                            <td style="font-size: 12px;">{{$row->imun1}}</td>
                            <td style="font-size: 12px;">{{$row->imun2}}</td>
                            <td style="font-size: 12px;">{{$row->imun3}}</td>
                            <td style="font-size: 12px;">{{$row->vitA_merah}}</td>
                            <td style="font-size: 12px;">{{$row->vitA_biru}}</td>
                            <td style="font-size: 12px;">{{$row->Fe_1}}</td>
                            <td style="font-size: 12px;">{{$row->Fe_2}}</td>
                            <td style="font-size: 12px;">{{$row->PMT}}</td>
                            <td style="font-size: 12px;">{{$row->asi_ekslusif}}</td>
                            <td style="font-size: 12px;">{{$row->oralit}}</td>
                            <td style="font-size: 12px;">{{$row->obat_cacing}}</td>
                            <td style="font-size: 12px;">{{$row->tanggal_pemeriksaan}}</td>
                            <td style="font-size: 12px;">{{$row->nama_bidan}}</td>
                            
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