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
        Riwayat Pertumbuhan Anak
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
                            <th>No.</th>
                            <th>Nama Anak</th>
                            <th>Imunisasi - 1</th>
                            <th>Imunisasi - 2</th>
                            <th>Imunisasi - 3</th>
                            <th>Vitamin A Merah</th>
                            <th>Vitamin A Biru</th>
                            <th>Fe-1</th>
                            <th>Fe-2</th>
                            <th>PMT</th>
                            <th>Asi Eksklusif</th>
                            <th>Oralit</th>
                            <th>Obat Cacing</th>
                            <th>Tanggal Pemeriksaan</th>
                            <th>Nama Bidan Pemeriksa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_anak as $i=>$row)
                        <tr>
                            <td class="text-center">{{++$i}}</td>
                            <td>{{$row->nama_anak}}</td>
                            <td>{{$row->imun1}}</td>
                            <td>{{$row->imun2}}</td>
                            <td>{{$row->imun3}}</td>
                            <td>{{$row->vitA_merah}}</td>
                            <td>{{$row->vitA_biru}}</td>
                            <td>{{$row->Fe_1}}</td>
                            <td>{{$row->Fe_2}}</td>
                            <td>{{$row->PMT}}</td>
                            <td>{{$row->asi_ekslusif}}</td>
                            <td>{{$row->oralit}}</td>
                            <td>{{$row->obat_cacing}}</td>
                            <td>{{$row->tanggal_pemeriksaan}}</td>
                            <td>{{$row->nama_bidan}}</td>
                            
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