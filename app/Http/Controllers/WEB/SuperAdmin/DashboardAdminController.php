<?php

namespace App\Http\Controllers\WEB\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Desa_kelurahan;
use App\Models\Kecamatan;
use App\Models\Orangtua;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $jumlah_anak = DB::table('anak')->count();
        $jumlah_ortu = DB::table('orangtua')->count();
        $jumlah_bidan = DB::table('bidan')->count();
        $jumlah_kader = DB::table('kader')->count();

        $data_kecamatan = Kecamatan::all();
        
        $data = Kecamatan::
        leftjoin('desa_kelurahan', 'desa_kelurahan.kecamatan_id', 'kecamatan.id')
        ->join('posyandu', 'posyandu.desa_kelurahan_id', 'desa_kelurahan.id')
        ->join('orangtua', 'orangtua.posyandu_id', 'posyandu.id')
        ->join('anak', 'anak.orangtua_id', 'orangtua.id')
        ->join('penimbangan', 'penimbangan.nik_anak', 'anak.nik_anak')
        ->get();

        foreach($data_kecamatan as $kecamatan)
        {
           $kecamatan['jumlah_sehat'] = $data
           ->where('nama_kecamatan', $kecamatan->nama_kecamatan)
           ->where('status_bb_tb','Normal')
           ->where('status_bb_pb','Normal')
           ->count();

           $kecamatan['jumlah_sakit'] = $data
           ->where('nama_kecamatan', $kecamatan->nama_kecamatan)
           ->where('status_bb_tb','Gizi buruk')
           ->where('status_bb_pb','Gizi buruk')
           ->count();
        }

// dd($data_kecamatan);
        

        return view('admin.dashboard', compact(['data_kecamatan','jumlah_anak','jumlah_ortu','jumlah_bidan','jumlah_kader']));
    }

    public function rekap_desa($id)
    {
        $data_desa = Desa_kelurahan::where('kecamatan_id', $id)->get();
        // ->where('kecamatan_id',$id)
        // ->get();

        $data = Kecamatan::
        leftjoin('desa_kelurahan', 'desa_kelurahan.kecamatan_id', 'kecamatan.id')
        ->join('posyandu', 'posyandu.desa_kelurahan_id', 'desa_kelurahan.id')
        ->join('orangtua', 'orangtua.posyandu_id', 'posyandu.id')
        ->join('anak', 'anak.orangtua_id', 'orangtua.id')
        ->join('penimbangan', 'penimbangan.nik_anak', 'anak.nik_anak')
        ->get();

        foreach($data_desa as $desa)
        {
           $desa['jumlah_sehat'] = $data
           ->where('nama', $desa->nama)
           ->where('status_bb_tb','Normal')
           ->where('status_bb_pb','Normal')
           ->count();

           $desa['jumlah_sakit'] = $data
           ->where('nama', $desa->nama)
           ->where('status_bb_tb','Gizi buruk')
           ->where('status_bb_pb','Gizi buruk')
           ->count();
        }

        // return $data_desa;

        return view('admin.rekap_desa', compact(['data_desa']));
    }

    public function rekap_posyandu($id)
    {
        $data_pos = Posyandu::
        join('desa_kelurahan','posyandu.desa_kelurahan_id','desa_kelurahan.id')
        ->select('posyandu.*','desa_kelurahan.nama')
        ->where('desa_kelurahan_id',$id)
        ->get();

        $data = Kecamatan::
        leftjoin('desa_kelurahan', 'desa_kelurahan.kecamatan_id', 'kecamatan.id')
        ->join('posyandu', 'posyandu.desa_kelurahan_id', 'desa_kelurahan.id')
        ->join('orangtua', 'orangtua.posyandu_id', 'posyandu.id')
        ->join('anak', 'anak.orangtua_id', 'orangtua.id')
        ->join('penimbangan', 'penimbangan.nik_anak', 'anak.nik_anak')
        ->get();

        foreach($data_pos as $pos)
        {

            
           $pos['jumlah_sehat'] = 0;
           $fsehat = $data
           ->where('nama_posyandu', $pos->nama_posyandu)
           ->whereIn('status_bb_tb',['Normal','Gizi baik'])
           ->whereIn('status_bb_pb',['Normal','Gizi baik']);
           $jsehat = array();
              foreach($fsehat as $sehat)
              {
                if(in_array($sehat->nik, $jsehat) == false)
                {
                    $pos['jumlah_sehat'] = $pos['jumlah_sehat'] + 1;
                   array_push($jsehat, $sehat->nik_anak);
                }
              }

           $pos['jumlah_sakit'] = 0;
           $fsakit = $data
           ->where('nama_posyandu', $pos->nama_posyandu)
           ->where('status_bb_tb','Gizi buruk')
           ->where('status_bb_pb','Gizi buruk');

            $jsakit = array();
            foreach($fsakit as $g)
            {
                if(in_array($g->nik_anak, $jsakit) == false){
                    $pos['jumlah_sakit'] = $pos['jumlah_sakit'] + 1;
                    array_push($jsakit, $g->nik_anak);
                }
            }

        }
       
        // return $data_pos;

        

        return view('admin.rekap_posyandu', compact('data_pos'));
    }

    
}
