<?php

namespace App\Http\Controllers\WEB\DinasKesehatan;

use App\Http\Controllers\Controller;
use App\Models\Desa_kelurahan;
use App\Models\Kecamatan;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class DashboardDinkesController extends Controller
{
    public function index()
    {
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
        

        return view('dinas_kesehatan.dashboard', compact(['data_kecamatan']));
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

        return view('dinas_kesehatan.rekap_desa', compact(['data_desa']));
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
           $pos['jumlah_sehat'] = $data
           ->where('orangtua.posyandu_id', $pos->id)
           ->where('anak.orangtua_id', 'orangtua.id')
           ->where('penimbangan.nik_anak', 'anak.nik_anak')
           ->where('penimbangan.status_bb_tb','Gizi baik')
           ->where('penimbangan.status_bb_pb','Gizi baik')
           ->count();

           $pos['jumlah_sakit'] = $data
           ->where('nama_posyandu', $pos->nama_posyandu)
           ->where('status_bb_tb','Gizi buruk')
           ->where('status_bb_pb','Gizi buruk')
           ->count();
        }
       
        return $data_pos;

        

        return view('dinas_kesehatan.rekap_posyandu', compact('data_pos'));
    }
}
