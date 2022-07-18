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
                            <th style="font-size: 12px;">No.</th>
                            <th style="font-size: 12px;">NIK Anak</th>
                            <th style="font-size: 12px;">Nama Anak</th>
                            <th style="font-size: 12px;">Jenis Kelamin</th>
                            <th style="font-size: 12px;">Tanggal lahir</th>
                            <th style="font-size: 12px;">Status Gizi Terakhir</th>
                            <th style="font-size: 12px;">Riwayat Pemeriksaan</th>
                            <th style="font-size: 12px;">Riwayat Penimbangan</th>
                            <th style="font-size: 12px;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_anak as $i=>$row)
                        <tr>
                            <td class="text-center" style="font-size: 12px;">{{++$i}}</td>
                            <td style="font-size: 12px;">{{$row->nik_anak}}</td>
                            <td style="font-size: 12px;">{{$row->nama_anak}}</td>
                            <td style="font-size: 12px;">{{$row->jenis_kelamin}}</td>
                            <td style="font-size: 12px;">{{$row->tanggal_lahir}}</td>
                            <td class="text-center" style="font-size: 12px;"><span class="badge bg-success ">Gizi Baik</span></td>
                            <td class="text-center" style="font-size: 12px;">
                                <a href="{{route('riwayat_pemeriksaan',$row->nik_anak)}}" class="btn btn-sm mb-2 btn-primary" style="font-size: 12px;" type="button"  >Lihat Riwayat</a>
                            </td>
                            <td class="text-center" style="font-size: 12px;">
                                <a href="{{route('riwayat_penimbangan',$row->nik_anak)}}" class=" btn btn-sm mb-2 btn-primary " style="font-size: 12px;" type="button" >Lihat Riwayat</a>
                            </td>
                            <td>
                                <a href="{{route('show_anak',$row->nik_anak)}}" class="btn btn-sm mb-2 btn-warning" type="button"><i class="ti-pencil"></i></a>
                                <form action="{{route('del_anak',$row->nik_anak)}}" method='post' class="d-inline" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini ?') ">
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




@endsection
@push('js')
<script src="{{asset('arfa/assets/js/login.js')}}"></script>
<script src="{{asset('arfa/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('arfa/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('arfa/vendor/izitoast/dist/js/iziToast.min.js')}}"></script>
@endpush