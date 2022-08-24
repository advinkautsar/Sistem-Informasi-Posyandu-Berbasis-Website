<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bidan;
use App\Models\Desa_kelurahan;
use App\Models\Imunisasi;
use App\Models\Jadwal_Imunisasi;
use App\Models\Kecamatan;
use App\Models\Puskesmas;
use App\Models\Tips_kesehatan;
use Illuminate\Support\Facades\DB;


class ListController extends Controller
{
    public function listanak()
    {

        $anak = DB::table('anak')
            ->leftJoin('orangtua', 'anak.orangtua_id', 'orangtua.id')
            ->join('posyandu', 'orangtua.posyandu_id', '=', 'posyandu.id')
            ->select('anak.*', 'orangtua.nama_ibu', 'orangtua.status_persetujuan', 'posyandu.nama_posyandu')
            ->where('status_persetujuan', '=', 'disetujui')
            ->get();

        if ($anak) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $anak
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function listOrtu_setuju()
    {
        $ortu = DB::table('orangtua')
            ->where('status_persetujuan', '=', 'disetujui')
            ->get();

        if ($ortu) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $ortu
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function listOrtu_belum()
    {
        $ortu = DB::table('orangtua')
            ->where('status_persetujuan', '=', 'belum disetujui')
            ->get();

        if ($ortu) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $ortu
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function listImunisasi()
    {
        $imunisasi = Imunisasi::all();

        if ($imunisasi) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $imunisasi
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function listPuskesmas()
    {
        $pus = Puskesmas::all();

        if ($pus) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $pus
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function listBidan()
    {
        $bidan = Bidan::all();

        if ($bidan) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $bidan
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function listKecamatan()
    {
        $kec = Kecamatan::all();

        if ($kec) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $kec
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function listDesa()
    {
        $desa = Desa_kelurahan::all();
        if ($desa) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $desa
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function create_imunisasi(Request $request)
    {

        $imun = Jadwal_Imunisasi::create([

            // 'jenis_imunisasi'=>$request->jenis_imunisasi,
            // 'waktu_imunisasi'=>$request->waktu_imunisasi,
            'bidan_id' => $request->bidan_id,
            'nik_anak' => $request->nik_anak,
            'imunisasi_id' => $request->imunisasi_id,
            'tanggal_imunisasi' => $request->tanggal_imunisasi,

        ]);

        if ($imun) {
            $data = [
                'status' => true,
                'pesan' => "Berhasil Mendaftarkan Imunisasi"
            ];
            return response()->json($data);
        } else {
            $data = [
                'status' => true,
                'pesan' => "Gagal Mendaftarkan Imunisasi"
            ];
            return response()->json($data);
        }
    }

    public function test()
    {

        // $i= Imunisasi::get();
        // $tokenList = Arr::pluck($i, 'token');
        // $token = $i[0]->token;



        // // return $i[0]->waktu_imunisasi;
        // $notif = new Notif();
        // $notif->sendNotif($tokenList, $i[0]->jenis_imunisasi. "Pada waktu ".$i[0]->waktu_imunisasi, "Notifikasi Imunisasi" );
        // return "sukses";

    }

    public function status()
    {
        $array = array(
            array('status' => 'Ya'),
            array('status' => 'Tidak')
        );
        if ($array) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $array
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function jenis_kelamin()
    {
        $array = array(array('jenis_kelamin' => 'L'), array('jenis_kelamin' => 'P'));

        //    return $array;

        if ($array) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $array
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function status_persetujuan()
    {
        $array = array(
            array('status_persetujuan' => 'disetujui'),
            array('status_persetujuan' => 'belum disetujui')
        );

        if ($array) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $array
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function listTips()
    {
        $tips = Tips_kesehatan::all();

        if ($tips) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $tips
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }
}
