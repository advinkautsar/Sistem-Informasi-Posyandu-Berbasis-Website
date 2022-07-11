@extends('layouts-admin.master')
@section('title 1')
Data Akun Petugas Desa
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('arfa/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('arfa/assets/css/bootstrap-override.css')}}">
<link rel="stylesheet" href="{{asset('arfa/vendor/izitoast/dist/css/iziToast.min.css')}}">
@endpush
@section('content')

<div class="col-md-12">
    <div class="title fw-bold mt-2 mb-3" style="font-size: 20px;">
        Pengelolaan Data Pengguna
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
            <a href="{{route('petdes.create')}}" class="btn mb-2 btn-primary btn-sm"><i class="me-2 ti-plus"></i>Tambah Akun Petugas Desa Baru</a>
            <p class="form-text mb-2">Berikut ini list data akun petugas Petugas Desa / Kelurahan Banyuwangi
            </p>

            <div class="table-responsive">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pengguna</th>
                            <th>Role</th>
                            <th>No Hp</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_user as $i=>$row)
                        <tr>
                            <td class="text-center">{{++$i}}</td>
                            <td>{{$row->nama_pengguna}}</td>
                            <td>{{$row->role}}</td>
                            <td>{{$row->no_hp}}</td>

                            <td>
                                <a href="{{route('petdes.edit',$row->id)}}" class="btn btn-sm mb-2 btn-warning" type="button"><i class="ti-pencil"></i></a>

                                <form action="{{route('petdes.destroy', $row->id)}}" method='post' class="d-inline" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini ?') ">
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