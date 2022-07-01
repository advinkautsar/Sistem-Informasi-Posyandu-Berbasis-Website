@extends('layouts-admin.master')
@section('title')
Rekapitulasi Pertumbuhan Anak Posyandu
@endsection
@section('content')

<div class="col-md-12">
    <div class="title fw-bold mt-2 mb-3" style="font-size: 20px;">
        @yield('title')
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Data Laporan Pertumbuhan Anak</h4>
        </div>
        <div class="card-body">

            <table id="example2" class="table display">
                <thead>
                    <tr>
                        <th style="text-align:center;">No.</th>
                        <th style="text-align:center;">Posyandu</th>
                        <th style="text-align:center;">Alamat</th>
                        <th style="text-align:center;">Periode Tahun</th>

                        <th style="text-align:center;">Lap. Format 2 - Register Bayi</th>
                        <th style="text-align:center;">Lap. Format 3 - Register Balita</th>
                        <th style="text-align:center;">Lap. Format 7 - Data Hasil Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($posyandu as $key => $data)
                        <td style="text-align:center;">{{$loop->iteration}} </td>
                        <td style="text-align:center;">{{$data->nama_posyandu}}</td>
                        <td style="text-align:center;">{{$data->nama}}</td>
                        <td style="text-align:center;">2020</td>

                        <td style="text-align:center;">
                            <a href="#" data-toggle="modal" onclick="deleteData()" data-target="#DeleteModal" class="btn btn-sm btn-success" data-placement="bottom" title="Laporan Data Balita Posyandu" style="color: white;"><i class="fas fa-file-excel"></i>
                        </td>
                        <td style="text-align:center;">
                            <a href="#" data-toggle="modal" onclick="deleteData()" data-target="#DeleteModal" class="btn btn-sm btn-success" data-placement="bottom" title="Laporan Data Bayi Posyandu" style="color: white;"><i class="fas fa-file-excel"></i>
                        </td>
                        <td style="text-align:center;">
                            <a href="#" data-toggle="modal" onclick="deleteData()" data-target="#DeleteModal" class="btn btn-sm btn-success" data-placement="bottom" title="Data Kegiatan Posyandu" style="color: white;"><i class="fas fa-file-excel"></i>
                        </td>

                    </tr>
                    @endforeach


                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection