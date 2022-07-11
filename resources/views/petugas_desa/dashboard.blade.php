@extends('layouts-admin.master')
@section('title')
Dashboard Petugas Desa
@endsection
@section('content')

<div class="col-md-12">
    <div class="title fw-bold mt-2 mb-3" style="font-size: 20px;">
        @yield('title')
    </div>
    <div class="card">
        <div class="card-header">
            <h4> Selamat Datang Petugas {{auth()->user()->petugas_desa->desa_kelurahan->nama}}</h4>
        </div>
        <div class="card-body">

            

        </div>
    </div>
</div>
@endsection