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
            <div class="row form-group gap-1 d-md-flex justify-content-end card-header ">
                <form class="form" method="get" action="{{ url('')}}">


                    <div class="row">
                        <div class="col-sm-3">
                            <label for="">Tanggal awal</label>
                            <input type="date" class="form-control ml-2" name="tanggal_awal" id="tanggal_awal">
                        </div>
                        <div class="col-sm-3">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" class="form-control ml-2" name="tanggal_akhir" id="tanggal_akhir">
                        </div>
                        <br>
                    </div>
                    <table id="example2" class="table display">
                        <thead>
                            <tr>
                                <th style="text-align:center;">No.</th>
                                <th style="text-align:center;">Posyandu</th>
                                <th style="text-align:center;">Alamat</th>

                                <th style="text-align:center;">Lap. Format 2 - Register Bayi</th>
                                <th style="text-align:center;">Lap. Format 3 - Register Balita</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($posyandu as $key => $data)
                                <td style="text-align:center;">{{$loop->iteration}} </td>
                                <td style="text-align:center;">{{$data->nama_posyandu}}</td>
                                <td style="text-align:center;">{{$data->nama}}</td>
                                <td style="text-align:center;">
                                    <button href="{{url('laporanbayi/'.$data->id)}}" onclick="send(this)" type="button" class="btn btn-sm btn-success" style="color: white;"><i class="fas fa-file-excel"></i>
                                    </button>
                                </td>
                                <td style="text-align:center;">
                                    <button href="{{url('laporanbalita/'.$data->id)}}" onclick="send(this)" type="button" class="btn btn-sm btn-success" style="color: white;"><i class="fas fa-file-excel"></i>
                                    </button>
                                </td>

                            </tr>
                            @endforeach


                        </tbody>

                    </table>
            </div>
        </div>
    </div>
    @endsection

    @section('js')

    <script>
        function send(url) {
            axios.post($(url).attr('href'), {
                    tanggal: $('#tanggal_awal').val(),
                    tanggal2: $('#tanggal_akhir').val()
                }, {
                    responseType: 'blob'
                })
                .then((response) => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'laporan.xlsx'); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                })
        }

       
    </script>


    @endsection