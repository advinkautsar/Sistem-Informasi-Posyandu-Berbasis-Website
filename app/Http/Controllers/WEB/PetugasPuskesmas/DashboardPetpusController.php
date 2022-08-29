<?php

namespace App\Http\Controllers\WEB\PetugasPuskesmas;

use App\Http\Controllers\Controller;
use App\Models\Desa_kelurahan;
use App\Models\Kecamatan;
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
        
        $data_desa = Desa_kelurahan::where('kecamatan_id', $data_user)->get();
        // ->where('kecamatan_id',$id)
        // ->get();

        $data = Kecamatan::leftjoin('desa_kelurahan', 'desa_kelurahan.kecamatan_id', 'kecamatan.id')
            ->join('posyandu', 'posyandu.desa_kelurahan_id', 'desa_kelurahan.id')
            ->join('orangtua', 'orangtua.posyandu_id', 'posyandu.id')
            ->join('anak', 'anak.orangtua_id', 'orangtua.id')
            ->join('penimbangan', 'penimbangan.nik_anak', 'anak.nik_anak')
            ->get();

        foreach ($data_desa as $desa) {
            $desa['jumlah_sehat'] = $data
                ->where('nama', $desa->nama)
                ->where('status_bb_tb', 'Gizi baik')
                ->where('status_bb_pb', 'Gizi baik')
                ->count();

            $desa['jumlah_sakit'] = $data
                ->where('nama', $desa->nama)
                ->where('status_bb_tb', 'Gizi Buruk')
                ->where('status_bb_pb', 'Gizi Buruk')
                ->count();
        }

        return view('petugas_puskesmas.dashboard', compact(['data_desa','jumlah_anak','jumlah_ortu','jumlah_bidan','jumlah_kader']));
    }

    public function rekap_posyandu_desa($id)
    {


        $data_pos = Posyandu::join('desa_kelurahan', 'posyandu.desa_kelurahan_id', 'desa_kelurahan.id')
            ->select('posyandu.*', 'desa_kelurahan.nama')
            ->where('desa_kelurahan_id', $id)
            ->get();

        $data = Kecamatan::leftjoin('desa_kelurahan', 'desa_kelurahan.kecamatan_id', 'kecamatan.id')
            ->join('posyandu', 'posyandu.desa_kelurahan_id', 'desa_kelurahan.id')
            ->join('orangtua', 'orangtua.posyandu_id', 'posyandu.id')
            ->join('anak', 'anak.orangtua_id', 'orangtua.id')
            ->join('penimbangan', 'penimbangan.nik_anak', 'anak.nik_anak')
            ->get();

        foreach ($data_pos as $pos) {


            $pos['jumlah_sehat'] = 0;
            $fsehat = $data
                ->where('nama_posyandu', $pos->nama_posyandu)
                ->whereIn('status_bb_tb', ['Gizi kurang', 'Gizi baik'])
                ->whereIn('status_bb_pb', ['Gizi kurang', 'Gizi baik']);
            $jsehat = array();
            foreach ($fsehat as $sehat) {
                if (in_array($sehat->nik, $jsehat) == false) {
                    $pos['jumlah_sehat'] = $pos['jumlah_sehat'] + 1;
                    array_push($jsehat, $sehat->nik_anak);
                }
            }

            $pos['jumlah_sakit'] = 0;
            $fsakit = $data
                ->where('nama_posyandu', $pos->nama_posyandu)
                ->where('status_bb_tb', 'Gizi Buruk')
                ->where('status_bb_pb', 'Gizi Buruk');

            $jsakit = array();
            foreach ($fsakit as $g) {
                if (in_array($g->nik_anak, $jsakit) == false) {
                    $pos['jumlah_sakit'] = $pos['jumlah_sakit'] + 1;
                    array_push($jsakit, $g->nik_anak);
                }
            }
        }

        // return $data_pos;
        return view('petugas_puskesmas.detail_rekap_pos',compact(['data_pos']));
    }
}
