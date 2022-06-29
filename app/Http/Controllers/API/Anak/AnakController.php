<?php

namespace App\Http\Controllers\API\Anak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Penimbangan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AnakController extends Controller
{
    public function ReadAnakDariOrtu($id)
    {
        $anak = DB::table('anak')        
            ->leftJoin('orangtua','anak.orangtua_id','orangtua.id')
            ->join('posyandu', 'orangtua.posyandu_id', '=', 'posyandu.id')
            ->select('anak.*', 'orangtua.nama_ibu','posyandu.nama_posyandu')
            ->where('orangtua_id', $id)
            ->get();

            
        if($anak){
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

    public function show($id)
    {
        $anak = DB::table('anak')        
            ->leftJoin('orangtua','anak.orangtua_id','orangtua.id')
            ->select('anak.*', 'orangtua.nama_ibu')
            ->where('nik_anak', $id)
            ->first();
    
        if($anak){
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

    public function showimunisasi($id)
    {
        // $anak = Pemeriksaan::where('nik_anak',$id)->get();
        $anak = DB::table('pemeriksaan')
            ->leftJoin('anak','pemeriksaan.nik_anak','anak.nik_anak')
            ->leftJoin('imunisasi','pemeriksaan.imunisasi_id_1','imunisasi.id')
            ->leftJoin('imunisasi as imunisasi2','pemeriksaan.imunisasi_id_2','imunisasi2.id')
            ->leftJoin('imunisasi as imunisasi3','pemeriksaan.imunisasi_id_3','imunisasi3.id')
            ->select('pemeriksaan.tanggal_pemeriksaan','imunisasi.jenis_imunisasi as imun1','imunisasi2.jenis_imunisasi as imun2',
            'imunisasi3.jenis_imunisasi as imun3','pemeriksaan.nik_anak','pemeriksaan.id')
            ->where('pemeriksaan.nik_anak', $id)->orderBy('id','DESC')
            ->get();

        if($anak){
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

    public function showstatusgizi($id)
    {
        $anak = Penimbangan::where('nik_anak',$id)
        ->orderBy('id','DESC')
        ->get();

        if($anak){
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

    public function create_timbang(Request $request)
    {

        $usia = DB::table('anak')->where('nik_anak',$request->nik_anak)->first();
        $usia->umur_bulan = Carbon::parse($usia->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%m');
        // return $usia->umur_bulan;

        $i_tb = $request->tinggi_badan;

        // $i=89.9;
        $status_tb='';

        
        $tb_u= DB::table('standart_tb_u')->where('umur_bulan',$usia->umur_bulan )->where('jk','laki-laki')->first();
        if($tb_u){
            if( ($tb_u->plus_2_sd <= $i_tb) && ($i_tb <= $tb_u->plus_3_sd)){
                $status_tb ='tinggi';
            }else if(($tb_u->plus_1_sd <= $i_tb) && ($i_tb <= $tb_u->plus_2_sd)){
                $status_tb ='normal 1';
            }elseif(($tb_u->median <= $i_tb) && ($i_tb <= $tb_u->plus_1_sd)){
                $status_tb = 'normal2';
            }elseif(($tb_u->min_1_sd <= $i_tb) && ($i_tb <= $tb_u->median)){
                $status_tb = 'normal3';
            }
            elseif(($tb_u->min_2_sd <= $i_tb) && ($i_tb <= $tb_u->min_1_sd)){
                $status_tb = 'normal4';
            }
            elseif(($tb_u->min_3_sd <= $i_tb) && ($i_tb <= $tb_u->min_2_sd)){
                $status_tb = 'pendek';
            }else{
                $status_tb ='sangat pendek';
            }
        }else{
            $status_tb ='data tidak tersedia';
        }
        // return $tb_u;
       
        // return $status_tb;


        $i_bb=$request->berat_badan;
        $status_bb='';
        
        $bb_u= DB::table('standart_bb_u')->where('umur_bulan',$usia->umur_bulan )->where('jk','laki-laki')->first();
        // return $bb_u;
        if( ( $i_bb >= $bb_u->plus_3_sd )){
            $status_bb ='obesitas';
        }else if(($i_bb >= $bb_u->plus_2_sd) && ($i_bb <= $bb_u->plus_3_sd)){
            $status_bb ='obesitas0';
        }elseif(($i_bb >= $bb_u->plus_1_sd) && ($i_bb <= $bb_u->plus_2_sd)){
            $status_bb = 'gemuk';
        }elseif(($i_bb >= $bb_u->median) && ($i_bb <= $bb_u->plus_1_sd)){
            $status_bb = 'normal3';
        }elseif(($i_bb >= $bb_u->min_1_sd) && ($i_bb <= $bb_u->median)){
            $status_bb = 'normal2';
        }elseif(($i_bb >= $bb_u->min_2_sd) && ($i_bb <= $bb_u->min_1_sd)){
            $status_bb = 'normal1';
        }
        elseif(($i_bb >= $bb_u->min_3_sd) && ($i_bb <= $bb_u->min_2_sd)){
            $status_bb = 'kurus';
        }else{
            $status_bb ='sangat kurus';
        }
        // return $status_bb;


        $i_lk=$request->lingkar_kepala;
        $status_lk='';

        $lk_u= DB::table('standart_lk_u')->where('umur_bulan',$usia->umur_bulan )->where('jk','laki-laki')->first();
        if( ($lk_u->plus_2_sd <= $i_lk) && ($i_lk <= $lk_u->plus_3_sd)){
            $status_lk ='lebih dr normal';
        }else if(($lk_u->plus_1_sd <= $i_lk) && ($i_lk <= $lk_u->plus_2_sd)){
            $status_lk ='lebih dr normal';
        }elseif(($lk_u->median <= $i_lk) && ($i_lk <= $lk_u->plus_1_sd)){
            $status_lk = 'normal2';
        }elseif(($lk_u->min_1_sd <= $i_lk) && ($i_lk <= $lk_u->median)){
            $status_lk = 'normal3';
        }
        elseif(($lk_u->min_2_sd <= $i_lk) && ($i_lk <= $lk_u->min_1_sd)){
            $status_lk = 'normal4';
        }
        elseif(($lk_u->min_3_sd <= $i_lk) && ($i_lk <= $lk_u->min_2_sd)){
            $status_lk ='lingkar kepala kurang dari normal';
        }else{
            $status_lk ='lingkar kepala kurang dari normal';
        }
        // return $status_lk;

        

      

  

        
        $data_baru = Penimbangan::create([
            'nik_anak'=>$request->nik_anak,
            'berat_badan'=>$request->berat_badan,
            'tinggi_badan'=>$request->tinggi_badan,
            'lingkar_kepala'=>$request->lingkar_kepala,
            'status_tb_u'=>$status_tb,
            'status_bb_u'=>$status_bb,
            'status_lk_u'=>$status_lk,
          
            // 'status_bb_tb',
            // 'status_imt_u',
        ]);
        if ($data_baru) {
            $data = [
                'status' => true,
                'pesan' => "Berhasil Mendaftarkan Data baru pengukuran dan penimbangan anak"
            ];
            return response()->json($data);
        } else {
            $data = [
                'status' => true,
                'pesan' => "Gagal Mendaftarkan data baru"
            ];
            return response()->json($data);
        }
    }

    public function create_anak(Request $request)
    {
        $data_anak = Anak::create([
            'nik_anak'=>$request->nik_anak,
            'orangtua_id'=>$request->orangtua_id,
            'nama_anak'=>$request->nama_anak,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'berat_lahir'=>$request->berat_lahir,
            'panjang_lahir'=>$request->panjang_lahir,

        ]);

        if ($data_anak) {
            $data = [
                'status' => true,
                'pesan' => "Berhasil Mendaftarkan Data baru pengukuran dan penimbangan anak"
            ];
            return response()->json($data);
        } else {
            $data = [
                'status' => true,
                'pesan' => "Gagal Mendaftarkan data baru"
            ];
            return response()->json($data);
        }
    }
}
