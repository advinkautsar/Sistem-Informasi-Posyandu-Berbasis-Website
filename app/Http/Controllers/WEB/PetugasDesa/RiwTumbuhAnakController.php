<?php

namespace App\Http\Controllers\WEB\PetugasDesa;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwTumbuhAnakController extends Controller
{
    public function index()
    {
        $user_petpus = auth()->user()->petugas_desa->desa_kelurahan_id;
        $data_anak = DB::table('user')
            ->join('orangtua', 'orangtua.user_id', 'user.id')
            ->join('anak', 'anak.orangtua_id', 'orangtua.id')
            ->select('user.id', 'orangtua.id', 'anak.*')
            ->where('role', '=', 'orangtua')
            ->where('desa_kelurahan_id', $user_petpus)
            ->get();


        // return $data_anak;
        return view('petugas_desa.riw_tumbuhAnak.index', compact(['data_anak']));
    }

    public function index_tambah()
    {
        $user_petpus = auth()->user()->petugas_desa->desa_kelurahan_id;
        $data_ortu = DB::table('orangtua')
            ->where('desa_kelurahan_id', $user_petpus)
            ->get();

            // return $data_ortu;
        return view('petugas_desa.riw_tumbuhAnak.create', compact(['data_ortu']));
    }

    public function store_anak(Request $request)
    {
        $request->validate([
            'nama_anak' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'panjang_lahir' => 'required',
            'nik_anak' => 'required',
            'orangtua_id' => 'required',
        ]);

        $create_anak = Anak::create([
            'nik_anak'=>$request->nik_anak,
            'orangtua_id'=>$request->orangtua_id,
            'nama_anak'=>$request->nama_anak,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'berat_lahir'=>$request->berat_lahir,
            'panjang_lahir'=>$request->panjang_lahir,
        ]);

        if ($create_anak) {
            return redirect()->route('indexriwayatpertumbuhan')->with('succes', 'Data Anak Berhasil Terdaftar');
        }
    }
}
