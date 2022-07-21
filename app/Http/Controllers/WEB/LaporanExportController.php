<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\HasilKegiatanExport;
use App\Exports\RegisterBalitaExport;
use App\Exports\RegisterBayiExport;
use App\Models\Orangtua;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanExportController extends Controller
{
    public function hasilkegiatan($id)
    {
        return Excel::download(new HasilKegiatanExport($id), 'DATA HASIL KEGIATAN POSYANDU.xlsx');
    }

    public function hasil_laporan_registrasi_balita($id, Request $request)
    {

        $data = DB::table('posyandu')->find($id);

        // $data_anak= Anak::where('posyandu_id', $id)->get();
        $ortu = Orangtua::where('posyandu_id', $id)->with(
            [
                'anaks.penimbangans'
                => function ($q) use ($request) {
                    $q->select("*", DB::raw('YEAR(created_at) year, MONTH(created_at) bulan'));
                },


                'anaks.pemeriksaans'
            ]
        )->get();
        $data->orangtua = $ortu;



        // return $request;
        return Excel::download(new RegisterBalitaExport($id, $request), 'DATA REGISTRASI BALITA.xlsx');
        // return $data->orangtua;



    }
    public function hasil_laporan_registrasi_bayi($id, Request $request)
    {
        //check query age of children
        // return $request;

        // return Excel::download(new HasilKegiatanExport($id), 'DATA HASIL KEGIATAN POSYANDU.xlsx');
        $data = DB::table('posyandu')->find($id);


        

        // $data_anak= Anak::where('posyandu_id', $id)->get();
        $ortu = Orangtua::where('posyandu_id', $id)->with(
            [
                'anaks.penimbangans'
                => function ($q) use ($request) {
                    $q->select("*", DB::raw('YEAR(created_at) year, MONTH(created_at) bulan'));
                },


                'anaks.pemeriksaans'
            ]
        )->get();

        // foreach ($ortu as $Orangtua) {
        
        //     if (!$Orangtua->anaks->isEmpty()) {
        //         foreach ($Orangtua->anaks as $anak) {
        //             $umuranak = $this->cekumur($anak->tanggal_lahir);
        //             if ($umuranak > 0 && $umuranak <= 24) {
                     
        //                 if (!$anak->penimbangans->isEmpty()) {
        //                     foreach ($anak->penimbangans as $penimbangan) {
                              
        //                     }
        //                 }
        //                 if (!$anak->pemeriksaans->isEmpty()) {
       
        //                     foreach ($anak->pemeriksaans as $pemeriksaan) {
        //                         $dtp = $pemeriksaan->where('imunisasi_id_1' ,4)->orWhere('imunisasi_id_2',4)->orWhere('imunisasi_id_3',4)->get();
                            
        //                         foreach($dtp as $dt){
        //                             $dt->dtp1 = $dtp[0]->tanggal_pemeriksaan ?? '-';
        //                             $dt->dtp2 = $dtp[1]->tanggal_pemeriksaan    ?? '-';
        //                             $dt->dtp3 = $dtp[2]->tanggal_pemeriksaan    ?? '-';
                                                                 
        //                         }
        //                         return $dtp;  

        //                     }
                        
                        
        //                 }
                       
        //             }
        //         }
        //     }
        // }
       

        $data->orangtua = $ortu;

        // foreach($data->orangtua as $row){
        //     $anak= DB::table('anak')->where('orangtua_id', $row->id)->get();
        //     // $data->orangtua->anak= $anak;
        //     $row->anak= $anak;

        // }
            // return $data->orangtua;

        // return $request;
        return Excel::download(new RegisterBayiExport($id, $request), 'DATA REGISTRASI BAYI.xlsx');
    



    }

    public function cekumur($tanggal_lahir)
    {
        $bulan =  \Carbon\Carbon::parse($tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%m');
        $tahun =  \Carbon\Carbon::parse($tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y');
        return $tahun * 12 + $bulan;
    }
}
