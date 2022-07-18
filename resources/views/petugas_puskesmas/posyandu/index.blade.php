@extends('layouts-admin.master')
@section('title 1')
Data Posyandu Wilayah {{auth()->user()->petugas_puskesmas->puskesmas->nama_puskesmas}}
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('arfa/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('arfa/assets/css/bootstrap-override.css')}}">
<link rel="stylesheet" href="{{asset('arfa/vendor/izitoast/dist/css/iziToast.min.css')}}">
@endpush
@section('content')

<div class="col-md-12">
    <div class="title fw-bold mt-2 mb-3" style="font-size: 20px;">
        Pengelolaan Data Posyandu
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

        <!-- @if(Session::get('fail'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('fail') }}
        </div>
        @endif


        @if(session()->get('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('sukses')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif -->

        <div class="card-body">
            <a href="{{route('kelola_posyandu.create')}}" class="btn mb-2 btn-primary btn-sm"><i class="me-2 ti-plus"></i>Tambah Posyandu Baru</a>
            <p class="form-text mb-2">Berikut ini list data posyandu yang terdaftar di sekitar lingkungan {{auth()->user()->petugas_puskesmas->puskesmas->nama_puskesmas}}
            </p>

            <div class="table-responsive">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style="font-size: 12px;">No.</th>
                            <th style="font-size: 12px;">Nama Posyandu</th>
                            <th style="font-size: 12px;">Alamat</th>
                            <th style="font-size: 12px;">Kelurahan / Desa</th>
                            <th style="font-size: 12px;">Hari Kegiatan</th>
                            <th style="font-size: 12px;">Minggu Kegiatan</th>
                            <th style="font-size: 12px;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_posyandu as $i=>$row)
                        <tr>
                            <td class="text-center" style="font-size: 12px;">{{++$i}}</td>
                            <td style="font-size: 12px;">{{$row->nama_posyandu}}</td>
                            <td style="font-size: 12px;">{{$row->alamat}}</td>
                            <td style="font-size: 12px;">{{$row->nama}}</td>
                            <td style="font-size: 12px;">{{$row->hari_kegiatan}}</td>
                            <td style="font-size: 12px;">{{$row->minggu_kegiatan}}</td>


                            <td>
                                <a href="{{route('kelola_posyandu.edit', $row->id)}}" class="btn btn-sm mb-2 btn-warning" type="button"><i class="ti-pencil"></i></a>
                                <form action="{{route('kelola_posyandu.destroy', $row->id)}}" method='post' class="d-inline" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini ?') ">
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