<?php

namespace App\Http\Controllers\WEB\PetugasPuskesmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapImunisasiController extends Controller
{
    public function index()
    {
        $data_user = auth()->user()->petugas_puskesmas->puskesmas->id;
        $data_pos = DB::table('posyandu')
        ->where('puskesmas_id',$data_user)
        ->get();

        return view('petugas_puskesmas.rekapitulasi_imunisasi.index', compact(['data_pos']));
    }
}
