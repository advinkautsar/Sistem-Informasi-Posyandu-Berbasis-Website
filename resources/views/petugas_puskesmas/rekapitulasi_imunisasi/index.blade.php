@extends('layouts-admin.master')
@section('title')
@endsection
@section('content')

<div class="col-md-12 title">
    <h4 class="fw-bold" style="font-size: 20px;"> Rekapitulasi Imunisasi
</h4>

    <!-- Table -->
    <div class="row same-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Jumlah Total Kebutuhan vaksin imunisasi Bulan : September 2022</h4>
                </div>

                <div class="card-body">
                    <!-- <a href="" class="btn mb-2 btn-primary btn-sm"><i class="me-2 ti-plus"></i>Daftar Anak Baru</a> -->
                    <p class="form-text mb-2">Berikut ini merupakan rekapitulasi total vaksin yang dibutuhkan di wilayah {{auth()->user()->petugas_puskesmas->puskesmas->nama_puskesmas}}
                    </p>

                    <div class="table-responsive">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" style="font-size: 12px;">No.</th>
                                    <th class="text-center" style="font-size: 12px;">Nama Posyandu</th>
                                    <th class="text-center" style="font-size: 12px;">DPT-HB-Hib 1</th>
                                    <th class="text-center" style="font-size: 12px;">Polio-2</th>
                                    <th class="text-center" style="font-size: 12px;">DPT-HB-Hib 2</th>
                                    <th class="text-center" style="font-size: 12px;">Polio-3</th>
                                    <th class="text-center" style="font-size: 12px;">DPT-HB-Hib 3</th>
                                    <th class="text-center" style="font-size: 12px;">Polio-4</th>
                                    <th class="text-center" style="font-size: 12px;">IPV</th>
                                    <th class="text-center" style="font-size: 12px;">Campak - Rubella (MR)</th>
                                    <th class="text-center" style="font-size: 12px;">DPT-HB-Hib Lanjutan</th>
                                    <th class="text-center" style="font-size: 12px;">Campak - Rubella ( MR ) Lanjutan</th>
                                    <th class="text-center" style="font-size: 12px;">PCV 1</th>
                                    <th class="text-center" style="font-size: 12px;">PCV 2</th>
                                    <th class="text-center" style="font-size: 12px;">PCV 3</th>
                                    <th class="text-center" style="font-size: 12px;">Japanese Encephalitis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_pos as $i=>$row)
                                <tr>
                                    <td class="text-center" style="font-size: 12px;">{{++$i}}</td>
                                    <td  style="font-size: 12px;">{{$row->nama_posyandu}}</td>
                                    <td class="text-center" style="font-size: 12px;">40</td>
                                    <td class="text-center" style="font-size: 12px;">31</td>
                                    <td class="text-center" style="font-size: 12px;">22</td>
                                    <td class="text-center" style="font-size: 12px;">11</td>
                                    <td class="text-center" style="font-size: 12px;">3</td>
                                    <td class="text-center" style="font-size: 12px;">9</td>
                                    <td class="text-center" style="font-size: 12px;">10</td>
                                    <td class="text-center" style="font-size: 12px;">12</td>
                                    <td class="text-center" style="font-size: 12px;">1</td>
                                    <td class="text-center" style="font-size: 12px;">2</td>
                                    <td class="text-center" style="font-size: 12px;">0</td>
                                    <td class="text-center" style="font-size: 12px;">0</td>
                                    <td class="text-center" style="font-size: 12px;">0</td>
                                    <td class="text-center" style="font-size: 12px;">0</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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