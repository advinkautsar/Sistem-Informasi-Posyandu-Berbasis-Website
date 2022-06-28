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
            <p class="form-text mb-2">Datatables also provide responsive table</p>
            <table id="example2" class="table display">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK ANAK</th>
                        <th>Nama Anak</th>
                    
                        <th>Grafik BB_PB</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($penimbangan as $key => $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->nik_anak}}</td>
                        <td>{{$data->nama_anak}} </td>
                       

                        <td>
                            <a href="#" data-toggle="modal" onclick="deleteData()" data-target="#DeleteModal" 
                            class="btn btn-sm btn-success" data-placement="bottom" title="grafik bb menurut pb" style="color: white;"><i class="fa fa-bars"></i></a>
                        </td>

                    </tr>
                    @endforeach


                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection