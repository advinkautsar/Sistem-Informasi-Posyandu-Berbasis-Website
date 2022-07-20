<?php

namespace App\Http\Controllers\WEB\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $data_kecamatan = Kecamatan::all();

        return view('admin.dashboard', compact(['data_kecamatan']));
    }

    public function rekap_desa($id)
    {
        $data_desa = DB::table('desa_kelurahan')
        ->where('kecamatan_id',$id)
        ->get();

        // return $data_desa;

        return view('admin.rekap_desa', compact(['data_desa']));
    }

    public function rekap_posyandu($id)
    {
        $data_pos = DB::table('posyandu')
        ->join('desa_kelurahan','posyandu.desa_kelurahan_id','desa_kelurahan.id')
        ->select('posyandu.*','desa_kelurahan.nama')
        ->where('desa_kelurahan_id',$id)
        ->get();

        return view('admin.rekap_posyandu', compact('data_pos'));
    }
}
