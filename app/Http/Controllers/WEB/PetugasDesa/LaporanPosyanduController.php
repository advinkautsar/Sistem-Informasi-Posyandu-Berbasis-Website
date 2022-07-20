<?php

namespace App\Http\Controllers\WEB\PetugasDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPosyanduController extends Controller
{
    public function index()
    {
        $data_user = auth()->user()->petugas_desa->desa_kelurahan_id;
        
        $data_pos = DB::table('posyandu')
        ->join('desa_kelurahan','posyandu.desa_kelurahan_id','desa_kelurahan.id')
        ->select('posyandu.*','desa_kelurahan.nama')
        ->where('desa_kelurahan_id', $data_user)
        ->get();

        // return $data_pos;

        return view('petugas_desa.laporan_posyandu.index', compact(['data_pos']));
    }
}
