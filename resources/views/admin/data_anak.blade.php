@extends('layouts-admin.master')
@section('title')
Daftar Riwayat Kesehatan Anak
@endsection
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>@yield('title')</h4>
        </div>
        <div class="card-body">
            <p class="form-text mb-2">Berikut ini merupakan data riwayat kesehatan anak per desa / kelurahan seluruh banyuwangi</p>
            <table id="example2" class="table display">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK ANAK</th>
                        <th>Nama Anak</th>
                        <th>Posyandu</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                      
                    </tr>
                  

                </tbody>
              
            </table>
        </div>
    </div>
</div>
@endsection