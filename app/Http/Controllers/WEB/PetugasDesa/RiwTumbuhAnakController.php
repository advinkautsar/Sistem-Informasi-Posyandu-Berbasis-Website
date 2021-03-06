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
            ->select('anak.nik_anak', 'orangtua.id', 'anak.*')
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
            'nik_anak' => $request->nik_anak,
            'orangtua_id' => $request->orangtua_id,
            'nama_anak' => $request->nama_anak,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'berat_lahir' => $request->berat_lahir,
            'panjang_lahir' => $request->panjang_lahir,
        ]);

        if ($create_anak) {
            return redirect()->route('indexriwayatpertumbuhan')->with('succes', 'Data Anak Berhasil Terdaftar');
        }
    }

    public function riwayat_pemeriksaan($id)
    {
        $data_anak = DB::table('anak')
            ->join('pemeriksaan', 'pemeriksaan.nik_anak', 'anak.nik_anak')
            ->join('bidan', 'pemeriksaan.bidan_id', 'bidan.id')
            ->join('imunisasi', 'pemeriksaan.imunisasi_id_1', 'imunisasi.id')
            ->leftJoin('imunisasi as imunisasi2', 'pemeriksaan.imunisasi_id_2', 'imunisasi2.id')
            ->leftJoin('imunisasi as imunisasi3', 'pemeriksaan.imunisasi_id_3', 'imunisasi3.id')
            ->select(
                'anak.*',
                'pemeriksaan.*',
                'imunisasi.jenis_imunisasi as imun1',
                'imunisasi2.jenis_imunisasi as imun2',
                'imunisasi3.jenis_imunisasi as imun3',
                'bidan.id as id_bidan',
                'bidan.nama_bidan as nama_bidan',
            )
            ->where('anak.nik_anak', $id)
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->get();

        // return $data_anak;

        return view('petugas_desa.riw_tumbuhAnak.riwayat_pemeriksaan', compact(['data_anak']));
    }

    public function riwayat_penimbangan($id)
    {
        $data_anak = DB::table('anak')
            ->join('penimbangan', 'penimbangan.nik_anak', 'anak.nik_anak')
            ->select('anak.*', 'penimbangan.*')
            ->where('anak.nik_anak', $id)
            ->orderBy('penimbangan.created_at', 'desc')
            ->get();

        // return $data_anak;
        return view('petugas_desa.riw_tumbuhAnak.riwayat_penimbangan', compact(['data_anak']));
    }

    public function riwayat_rujukan($id)
    {
        $data_anak = DB::table('anak')
        ->join('rujukan','rujukan.nik_anak','anak.nik_anak')
        ->join('bidan','rujukan.bidan_id','bidan.id')
        ->join('puskesmas','bidan.puskesmas_id','puskesmas.id')
        ->select('anak.*','rujukan.*', 'bidan.nama_bidan','puskesmas.nama_puskesmas')
        ->where('anak.nik_anak',$id)
        ->orderBy('rujukan.created_at', 'desc')
        ->get();

        // return $data_anak;

        return view('petugas_desa.riw_tumbuhAnak.riwayat_rujukan', compact(['data_anak']));
    }

    public function detail_anak($id)
    {
        $data_anak = DB::table('anak')
        ->join('orangtua', 'anak.orangtua_id','orangtua.id')
        ->select('anak.*','orangtua.nama_ibu')
        ->where('anak.nik_anak',$id)
        ->first();

        // return $data_anak;
        return view('petugas_desa.riw_tumbuhAnak.detail_anak', compact(['data_anak']));
    }

    public function show_anak($id)
    {
        $data_anak = DB::table('anak')
            ->where('anak.nik_anak', $id)
            ->first();

        return view('petugas_desa.riw_tumbuhAnak.edit_anak', compact(['data_anak']));
    }

    public function update_anak(Request $request, $id)
    {
        $request->validate([
            'nama_anak' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'berat_lahir' => 'required',
            'panjang_lahir' => 'required',
            'nik_anak' => 'required',
        ]);

        $data_anak = Anak::where('nik_anak',$id)->first();

        $update_anak = $data_anak->update([
            'nik_anak' => $request->nik_anak,
            'nama_anak' => $request->nama_anak,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'berat_lahir' => $request->berat_lahir,
            'panjang_lahir' => $request->panjang_lahir,
        ]);

        if ($update_anak) {
            return redirect()->route('indexriwayatpertumbuhan')->with('succes', 'Profil Anak berhasil di Perbarui');
        }
    }

    public function del_anak($id)
    {
        $del = Anak::where('nik_anak',$id);

        $del->delete();

        return redirect()->route('indexriwayatpertumbuhan')->with('succes', 'Data anak berhasil terhapus');
    }
}
