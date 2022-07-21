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
        $data_user = auth()->user()->petugas_puskesmas->puskesmas->kecamatan_id;
        $data_desa = DB::table('desa_kelurahan')
        ->where('kecamatan_id',$data_user)
        ->get();

        return view('petugas_puskesmas.dashboard', compact(['data_desa']));
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
