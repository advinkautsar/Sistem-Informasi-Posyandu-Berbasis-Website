@extends('layouts-admin.master')
@section('title 1')
Data Orangtua di  {{auth()->user()->petugas_desa->desa_kelurahan->nama}}
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
            <a href="{{route('kelola_ortu.create')}}" class="btn mb-2 btn-primary btn-sm"><i class="me-2 ti-plus"></i>Daftar Akun Orangtua Baru</a>
            <p class="form-text mb-2">Berikut ini merupakan data seluruh orangtua yang terdaftar di wilayah {{auth()->user()->petugas_desa->desa_kelurahan->nama}}
            </p>

            <div class="table-responsive">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Orangtua ( Ibu )</th>
                            <th>NIK Ibu</th>
                            <th>Nama Orangtua ( Suami )</th>
                            <th>NIK Ayah</th>
                            <th>Alamat Rumah</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_ortu as $i=>$row)
                        <tr>
                            <td class="text-center">{{++$i}}</td>
                            <td>{{$row->nama_ibu}}</td>
                            <td>{{$row->nik_ibu}}</td>
                            <td>{{$row->nama_ayah}}</td>
                            <td>{{$row->nik_ayah}}</td>
                            <td>{{$row->alamat}}</td>
                            <td>
                                <a href="{{route('kelola_ortu.show',$row->id)}}" class="btn btn-sm mb-2 btn-primary" type="button"><i class="ti-eye"></i></a>
                                <a href="{{route('kelola_ortu.edit',$row->id)}}" class="btn btn-sm mb-2 btn-warning" type="button"><i class="ti-pencil"></i></a>
                                <form action="{{route('kelola_ortu.destroy',$row->id)}}" method='post' class="d-inline" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini ?') ">
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