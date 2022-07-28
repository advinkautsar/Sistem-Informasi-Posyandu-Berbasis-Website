@extends('layouts-admin.master')
@section('title')
@endsection
@section('content')

<div class="col-md-12 title">
    <h4 class="fw-bold" style="font-size: 20px;">Selamat Datang di Dashboar Dinas Kesehatan
</h4>

    <!-- Keterangan Jumlah Terdaftar -->
    <!-- <div class="row same-height mt-3">

        <div class="col-md-3">
            <div class="card text-center">
                <div class="text mt-2">
                    <span class="fw-bold">Total Anak Terdaftar</span>
                </div>
                <span style="font-size: 2rem ;">80</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="text mt-2">
                    <span class="fw-bold">Total Orangtua Terdaftar</span>
                </div>
                <span style="font-size: 2rem ;">76</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="text mt-2">
                    <span class="fw-bold">Total Bidan Terdaftar</span>
                </div>
                <span style="font-size: 2rem ;">2</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="text mt-2">
                    <span class="fw-bold">Total Kader Terdaftar</span>
                </div>
                <span style="font-size: 2rem ;">32</span>
            </div>
        </div>

    </div> -->

    <!-- Grafik -->
    <!-- <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Data Anak</h4>
            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="myChart" height="200" width="433" style="display: block; width: 433px; height: 200px;" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div> -->

    <!-- Table -->
    <div class="row same-height mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Rekapitulasi Data Anak Per Desa/Kelurahan</h4>
                </div>

                <div class="card-body">
                    <!-- <a href="" class="btn mb-2 btn-primary btn-sm"><i class="me-2 ti-plus"></i>Daftar Anak Baru</a> -->
                    <p class="form-text mb-2">Berikut ini merupakan rekapitulasi data anak berdasarkan desa/kelurahan pada kecamatan terpilih.
                    </p>

                    <div class="table-responsive">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" style="font-size: 12px;">No.</th>
                                    <th class="text-center" style="font-size: 12px;">Nama Desa/Kelurahan</th>
                                    <th class="text-center" style="font-size: 12px;">Jumlah Anak Sehat</th>
                                    <th class="text-center" style="font-size: 12px;">Jumlah Anak Sakit</th>
                                    <th class="text-center" style="font-size: 12px;">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_desa as $i=>$row)
                                <tr>
                                    <td class="text-center" style="font-size: 12px;">{{++$i}}</td>
                                    <td  style="font-size: 12px;">{{$row->nama}}</td>
                                    <td class="text-center" style="font-size: 12px;">{{$row->jumlah_sehat}}</td>
                                    <td class="text-center" style="font-size: 12px;">{{$row->jumlah_sakit}}</td>
                                    <td class="text-center" style="font-size: 12px;"><a href="{{route('rekap_posyandu_dinkes', $row->id)}}" class="btn btn-sm mb-2 btn-primary" type="button">Lihat Detail</a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a href="{{route('dashboard_dinkes')}}" class="btn btn-light btn-sm me-2 mt-3"><i class="me-2 ti-arrow-left"></i>Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Rekapitulasi Data Anak Stunting</h4>
                </div>
                <div class="card-body">
                    <p class="form-text mb-2">Datatables also provide responsive table</p>
                    <table id="example2" class="table display">
                        <thead>
                            <tr>
                                <th class="text-center" style="font-size: 12px;">No</th>
                                <th class="text-center" style="font-size: 12px;">Nama Anak</th>
                                <th class="text-center" style="font-size: 12px;">Jenis Kelamin </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
    </div>


</div>
@endsection