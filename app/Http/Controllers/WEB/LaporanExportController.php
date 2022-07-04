<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\HasilKegiatanExport;
use App\Exports\RegisterBalitaExport;
use App\Models\Orangtua;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanExportController extends Controller
{
    public function hasilkegiatan($id)
    {
        return Excel::download(new HasilKegiatanExport($id), 'DATA HASIL KEGIATAN POSYANDU.xlsx');
    }

    public function hasil_laporan_registrasi_balita($id)
    {
        //check query age of children

        // return Excel::download(new HasilKegiatanExport($id), 'DATA HASIL KEGIATAN POSYANDU.xlsx');
        $data = DB::table('posyandu')->find($id);

        // $data_anak= Anak::where('posyandu_id', $id)->get();
        $ortu = Orangtua::where('posyandu_id', $id)->with(['anaks.penimbangans'
        =>function($q) {
            $q->select("*",DB::raw('YEAR(created_at) year, MONTH(created_at) bulan'))->get();
        },
  
        'anaks.pemeriksaans'
        ]
        )->get();
        $data->orangtua= $ortu;
       
        // foreach($data->orangtua as $row){
        //     $anak= DB::table('anak')->where('orangtua_id', $row->id)->get();
        //     // $data->orangtua->anak= $anak;
        //     $row->anak= $anak;

        // }
      
        
        return Excel::download(new RegisterBalitaExport($id), 'DATA REGISTRASI BALITA.xlsx');
        // return $data->orangtua;


        // foreach($data->orangtua->anak as $row){
        //     $pemeriksaan = Pemeriksaan::where('nik_anak', $row->nik_anak)->get();
        //     $row->pemeriksaan= $pemeriksaan;
        // }

       
 
      
        // $data = DB::table('pemeriksaan')->Join('anak', 'pemeriksaan.nik_anak', '=', 'anak.nik_anak')
        // ->join('orangtua', 'anak.orangtua_id', '=', 'orangtua.id')
        // ->Join('posyandu', 'orangtua.posyandu_id', '=', 'posyandu.id')
        // // ->leftJoin('kecamatan', 'posyandu.kecamatan_id', '=', 'kecamatan.id')
        // ->Join('desa_kelurahan', 'posyandu.desa_kelurahan_id', '=', 'desa_kelurahan.id')
        // ->Join('kecamatan', 'desa_kelurahan.kecamatan_id', '=', 'kecamatan.id')
        // ->where('posyandu.id', $id)->get();

        // return $data;

       
    }
}
