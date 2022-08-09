<?php

namespace App\Http\Controllers\WEB\PetugasPuskesmas;

use App\Http\Controllers\Controller;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPetpusController extends Controller
{
    public function index()
    {

        $puskesmas_id = auth()->user()->petugas_puskesmas->puskesmas->id;
        
        $jumlah_anak = DB::table('anak')
        ->join('orangtua','anak.orangtua_id','orangtua.id')
        ->join('posyandu','orangtua.posyandu_id','posyandu.id')
        ->select('anak.*','orangtua.*','posyandu.*')
        ->where('puskesmas_id',$puskesmas_id)
        ->count();

        $jumlah_ortu = DB::table('orangtua')
        ->join('posyandu','orangtua.posyandu_id','posyandu.id')
        ->select('orangtua.*','posyandu.*')
        ->where('puskesmas_id',$puskesmas_id)
        ->count();

        $jumlah_bidan = DB::table('bidan')
        ->where('puskesmas_id',$puskesmas_id)
        ->count();

        $jumlah_kader = DB::table('kader')
        ->join('posyandu','kader.posyandu_id','posyandu.id')
        ->select('kader.*','posyandu.*')
        ->where('puskesmas_id',$puskesmas_id)
        ->count();



        $data_user = auth()->user()->petugas_puskesmas->puskesmas->kecamatan_id;
        $data_desa = DB::table('desa_kelurahan')
        ->where('kecamatan_id',$data_user)
        ->get();

        return view('petugas_puskesmas.dashboard', compact(['data_desa','jumlah_anak','jumlah_ortu','jumlah_bidan','jumlah_kader']));
    }

    public function rekap_posyandu_desa($id)
    {


        $data_pos = DB::table('posyandu')
        ->join('desa_kelurahan','posyandu.desa_kelurahan_id','desa_kelurahan.id')
        ->select('posyandu.*','desa_kelurahan.nama')
        ->where('desa_kelurahan_id',$id)
        ->get();

        // return $data_pos;
        return view('petugas_puskesmas.detail_rekap_pos',compact(['data_pos']));
    }
}
