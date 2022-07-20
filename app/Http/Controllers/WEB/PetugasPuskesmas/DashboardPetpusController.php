<?php

namespace App\Http\Controllers\WEB\PetugasPuskesmas;

use App\Http\Controllers\Controller;
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
}
