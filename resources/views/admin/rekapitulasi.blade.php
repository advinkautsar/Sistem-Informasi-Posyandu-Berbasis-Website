@extends('layouts-admin.master')
@section('title')
Rekapitulasi Pertumbuhan Anak
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
                        <th>Posyandu</th>
                        <th>Laporan 1</th>
                        <th>Laporan 2</th>
                        <th>Laporan 3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1 </td>
                        <td>Tiger Nixon</td>
                        <td> </td>
                        <td> </td>

                        <td>
                            <a href="#" data-toggle="modal" onclick="deleteData()" data-target="#DeleteModal" 
                            class="btn btn-sm btn-success" data-placement="bottom" title="Laporan2" style="color: white;"><i class="fa fa-print"></i></a>
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" onclick="deleteData()" data-target="#DeleteModal" 
                            class="btn btn-sm btn-success" data-placement="bottom" title="Laporan2" style="color: white;"><i class="fa fa-print"></i></a>
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" onclick="deleteData()" data-target="#DeleteModal" 
                            class="btn btn-sm btn-success" data-placement="bottom" title="Laporan2" style="color: white;"><i class="fa fa-print"></i></a>
                        </td>

                    </tr>


                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection