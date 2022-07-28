<?php

namespace App\Http\Controllers\WEB\DinasKesehatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataAnakDinkesController extends Controller
{
    public function index()
    {
        $data_anak = DB::table('anak')
        ->join('orangtua','anak.orangtua_id','orangtua.id')
        ->join('posyandu','orangtua.posyandu_id','posyandu.id')
        ->join('desa_kelurahan','orangtua.desa_kelurahan_id','desa_kelurahan.id')
        ->select('anak.*','orangtua.*','posyandu.nama_posyandu','desa_kelurahan.nama')
        ->get();

        return view('dinas_kesehatan.data_anak.index',compact(['data_anak']));
    }

    public function riw_pemeriksaan($id)
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

        return view('dinas_kesehatan.data_anak.riw_pemeriksaan', compact(['data_anak']));
    }

    public function riw_penimbangan($id)
    {
        $data_anak = DB::table('anak')
            ->join('penimbangan', 'penimbangan.nik_anak', 'anak.nik_anak')
            ->select('anak.*', 'penimbangan.*')
            ->where('anak.nik_anak', $id)
            ->orderBy('penimbangan.created_at', 'desc')
            ->get();

        // return $data_anak;
        return view('dinas_kesehatan.data_anak.riw_penimbangan', compact(['data_anak']));
    }

    public function riw_rujukan($id)
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

        return view('dinas_kesehatan.data_anak.riw_rujukan', compact(['data_anak']));
    }

    public function profil_anak($id)
    {
        $data_anak = DB::table('anak')
        ->join('orangtua', 'anak.orangtua_id','orangtua.id')
        ->join('desa_kelurahan','orangtua.desa_kelurahan_id','desa_kelurahan.id')
        ->join('kecamatan','orangtua.kecamatan_id','kecamatan.id')
        ->select('anak.*','orangtua.*','desa_kelurahan.nama','kecamatan.nama_kecamatan')
        ->where('anak.nik_anak',$id)
        ->first();

        // return $data_anak;
        return view('dinas_kesehatan.data_anak.profil_anak', compact(['data_anak']));
    }
}
