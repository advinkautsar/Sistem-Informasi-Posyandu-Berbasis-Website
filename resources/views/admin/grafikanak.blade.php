@extends('layouts-admin.master')
@section('title')
Grafik Anak
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
                        <th style="text-align:center;">NIK ANAK</th>
                        <th style="text-align:center;">Nama Anak</th>
                        <th style="text-align:center;">Grafik BB_PB</th>
                        <th style="text-align:center;">Grafik BB_TB</th>
                        <th style="text-align:center;">Grafik PB_U</th>
                        <th style="text-align:center;">Grafik BB_U</th>
                        <th style="text-align:center;">Grafik TB_U</th>
                        <th style="text-align:center;">Grafik IMT_U</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($penimbangan as $key => $data)
                    <tr>
                        <td style="text-align:center;">{{$loop->iteration}}</td>
                        <td style="text-align:center;">{{$data->nik_anak}}</td>
                        <td style="text-align:center;">{{$data->nama_anak}} </td>


                        <td style="text-align:center;">
                            <a href="{{url('grafik/standart_bb_pb',$data->id)}}" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                        </td>
                        <td style="text-align:center;">
                            <a href="{{url('grafik/standart_bb_tb',$data->id)}}" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                        </td>
                      
                        <td style="text-align:center;">
                            <a href="{{url('grafik/standart_pb_u',$data->id)}}" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                        </td>
                        <td style="text-align:center;">
                            <a href="{{url('grafik/standart_bb_u',$data->id)}}" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                        </td>
                        <td style="text-align:center;">
                            <a href="{{url('grafik/standart_tb_u',$data->id)}}" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                        </td>
                        <td style="text-align:center;">
                            <a href="{{url('grafik/standart_imt_u',$data->id)}}" class="btn btn-sm btn-success"><i class="fas fa-chart-bar"></i>
                        </td>

                    </tr>
                    @endforeach


                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection