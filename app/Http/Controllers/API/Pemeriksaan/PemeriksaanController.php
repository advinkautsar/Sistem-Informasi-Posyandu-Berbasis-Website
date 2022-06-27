<?php

namespace App\Http\Controllers\API\Pemeriksaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\DB;


class PemeriksaanController extends Controller
{
    public function create(Request $request)
    {
        $periksa = Pemeriksaan::create([

            'bidan_id' => $request->bidan_id,
            'nik_anak' => $request->nik_anak,
            'imunisasi_id_1' => $request->imunisasi_id_1,
            'imunisasi_id_2' => $request->imunisasi_id_2,
            'imunisasi_id_3' => $request->imunisasi_id_3,
            'vitA_merah' => $request->vitA_merah,
            'vitA_biru' => $request->vitA_biru,
            'Fe_1' => $request->Fe_1,
            'Fe_2' => $request->Fe_2,
            'PMT' => $request->PMT,
            'asi_ekslusif' => $request->asi_ekslusif,
            'oralit' => $request->oralit,
            'obat_cacing' => $request->obat_cacing,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan


        ]);

        if ($periksa) {
            $data = [
                'status' => true,
                'pesan' => "Data Pemeriksaan berhasil ditambahkan"
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => true,
                'pesan' => "Gagal Menambahkan Data Pemeriksaan"
            ];
            return response()->json($data, 404);
        }
    }

    public function getall()
    {
        $pemeriksaan = Pemeriksaan::all();
        return response()->json([
            'message' => 'succes',
            'data' => $pemeriksaan
        ]);
    }

    public function read($id)
    {
        $pemeriksaan = DB::table('pemeriksaan')
            ->rightJoin('anak', 'pemeriksaan.nik_anak', 'anak.nik_anak')
            ->leftJoin('imunisasi', 'pemeriksaan.imunisasi_id_1', 'imunisasi.id')
            ->leftJoin('imunisasi as imunisasi2', 'pemeriksaan.imunisasi_id_2', 'imunisasi2.id')
            ->leftJoin('imunisasi as imunisasi3', 'pemeriksaan.imunisasi_id_3', 'imunisasi3.id')
            ->rightJoin('bidan', 'pemeriksaan.bidan_id', 'bidan.id')
            ->select(
                'anak.nik_anak',
                'imunisasi.jenis_imunisasi as imun1',
                'imunisasi2.jenis_imunisasi as imun2',
                'imunisasi3.jenis_imunisasi as imun3',
                'bidan.id as id_bidan',
                'bidan.nama_bidan as nama_bidan',
                'pemeriksaan.*'
            )
            ->where('pemeriksaan.nik_anak', $id)
            ->orderBy('pemeriksaan.id', 'desc')
            ->get();

        if ($pemeriksaan) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $pemeriksaan
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function show($id)
    {
        $pemeriksaan = DB::table('pemeriksaan')
            ->leftJoin('anak', 'pemeriksaan.nik_anak', 'anak.nik_anak')
            ->leftJoin('imunisasi', 'pemeriksaan.imunisasi_id_1', 'imunisasi.id')
            ->leftJoin('imunisasi as imunisasi2', 'pemeriksaan.imunisasi_id_2', 'imunisasi2.id')
            ->leftJoin('imunisasi as imunisasi3', 'pemeriksaan.imunisasi_id_3', 'imunisasi3.id')
            ->leftJoin('bidan', 'pemeriksaan.bidan_id', 'bidan.id')
            ->select(
                'anak.nik_anak',
                'imunisasi.jenis_imunisasi as imun1',
                'imunisasi2.jenis_imunisasi as imun2',
                'imunisasi3.jenis_imunisasi as imun3',
                'anak.*',
                'bidan.id as id_bidan',
                'bidan.nama_bidan as nama_bidan',
                'pemeriksaan.*'
            )
            ->where('pemeriksaan.id', $id)
            ->first();

        if ($pemeriksaan) {
            return response()->json([
                'status'    => 'success',
                'message'   => 'Data tersedia',
                'data'      => $pemeriksaan
            ], 200);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data tidak tersedia',
                'data'      => []
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $periksa = Pemeriksaan::find($id);
        $periksa->update($request->all());

        if ($periksa) {
            $data = [
                'status' => true,
                'pesan' => "Data Pemeriksaan berhasil diubah"
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => true,
                'pesan' => "Gagal Merubah Data Pemeriksaan"
            ];
            return response()->json($data, 404);
        }
    }

    public function delete(Request $request, $id)
    {
        $periksa = Pemeriksaan::find($id);

        if (!empty($periksa)) {
            $periksa->delete();
            $data = [
                'status' => true,
                'pesan' => "Data Pemkes berhasil dihapus"
            ];
            return response()->json($data, 200);
        } else {
            return response()->json([
                'error' => 'Data Tidak Ditemukan'
            ], 404);
        }
    }
}
