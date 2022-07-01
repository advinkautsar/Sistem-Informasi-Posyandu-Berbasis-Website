@extends('layouts-admin.master')
@section('title')
Rekapitulasi Pertumbuhan Anak Posyandu
@endsection
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>@yield('title')</h4>
        </div>
        <div class="card-body">
        
            <table id="example2" class="table display">
                <thead>
                    <tr>
                        <th style="text-align:center;">No.</th>
                        <th style="text-align:center;">Posyandu</th>
                        <th style="text-align:center;">Alamat</th>
     
                        <th style="text-align:center;">Lap. Data Balita</th>
                        <th style="text-align:center;">Lap. Data Bayi</th>
                        <th style="text-align:center;">Lap. Kegiatan </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($posyandu as $key => $data)
                        <td style="text-align:center;">{{$loop->iteration}} </td>
                        <td style="text-align:center;">{{$data->nama_posyandu}}</td>
                        <td style="text-align:center;">{{$data->nama}}</td>
                        <td style="text-align:center;">
                            <a href="{{url('laporanbalita/'.$data->id)}}" 
                            class="btn btn-sm btn-success"  style="color: white;"><i class="fas fa-file-excel"></i>
                        </td>
                        <td style="text-align:center;">
                            <a href="#" data-toggle="modal" onclick="deleteData()" data-target="#DeleteModal" 
                            class="btn btn-sm btn-success" data-placement="bottom" title="Laporan Data Bayi Posyandu" style="color: white;"><i class="fas fa-file-excel"></i>
                        </td>
                        <td style="text-align:center;">
                            <a href="#" data-toggle="modal" onclick="deleteData()" data-target="#DeleteModal" 
                            class="btn btn-sm btn-success" data-placement="bottom" title="Data Kegiatan Posyandu" style="color: white;"><i class="fas fa-file-excel"></i>
                        </td>

                    </tr>
                    @endforeach


                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection