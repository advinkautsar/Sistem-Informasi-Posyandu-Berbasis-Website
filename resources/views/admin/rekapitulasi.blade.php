@extends('layouts-admin.master')
@section('title')
Rekapitulasi Pertumbuhan Anak Posyandu
@endsection

@section('css')
<style>
.loding-progress{
    width: 100vw;
    position:absolute;
        height: auto;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
}
.loding-progress ul { 
    display: table;
    margin-left: auto;
    margin-right: auto;
    list-style: none;
}
.loding-progress li { 
  float: left;
  width: 16px; 
  height: 64px;
  background: #aeb5da;
  border: 1px solid #8490c6;
  box-sizing: border-box;
  margin-right:8px;
  opacity: 0.2;
}

.loding-progress li:nth-child(1) {
  animation-name: anim;
  animation-duration: .9s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
}
.loding-progress li:nth-child(2) {
  animation-name: anim;
  animation-duration: .9s;
  animation-delay: .3s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
}
.loding-progress li:nth-child(3) {
  animation-name: anim;
  animation-duration: .9s;
  animation-delay: .6s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
}

@keyframes anim {
  from {
    opacity: 1;
    transform: scale(1.1);
  }
  to {
    opacity: 0.2;
    transform: scale(1);
  }
}
</style>
@endsection

@section('content')

<div class="loding-progress d-none">
<ul>
  <li></li>
  <li></li>
  <li></li>
</ul>
</div>

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


                    <div class="row mb-3">
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
                                    <button href="{{url('laporanbayi/'.$data->id)}}" onclick="sendbayi(this)" type="button" class="btn btn-sm btn-success" style="color: white;"><i class="fas fa-file-excel"></i>
                                    </button>
                                </td>
                                <td style="text-align:center;">
                                    <button href="{{url('laporanbalita/'.$data->id)}}" onclick="send(this)" type="button" class="btn btn-sm btn-success" style="color: white;"><i class="fas fa-file-excel"></i>
                                    </button>
                                </td>

                                <!-- <td style="text-align:center;">
                                    <a href="{{url('laporanbayi/'.$data->id)}}"  class="btn btn-sm btn-success" style="color: white;"><i class="fas fa-file-excel"></i>
</a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="{{url('laporanbalita/'.$data->id)}}" class="btn btn-sm btn-success" style="color: white;"><i class="fas fa-file-excel"></i>
</a>
                                </td> -->

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
            $(".loding-progress").removeClass("d-none");
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
                    link.setAttribute('download', 'DATA REGISTRASI BALITA.xlsx'); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                $(".loding-progress").addClass("d-none");
                }).catch((error) => {
                    console.log(error);
                });
        }

        function sendbayi(url) {
            $(".loding-progress").removeClass("d-none");
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
                    link.setAttribute('download', 'DATA REGISTRASI BAYI.xlsx'); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                $(".loding-progress").addClass("d-none");
                }).catch((error) => {
                    console.log(error);
                });
        }

       
    </script>


    @endsection