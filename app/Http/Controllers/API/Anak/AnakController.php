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
        // $usia->umur_bulan = Carbon::parse($usia->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%m');
        $umuranak = $this->cekumur($usia->tanggal_lahir);
        // return $umuranak;
        $jk='';	
        if($usia->jenis_kelamin=='L'){
            $jk='Laki-laki';

        }else{
            $jk='Perempuan';

        }
    

        $i_tb = $request->tinggi_badan;

        // $i=89.9;
        $status_tb='';

        
        $tb_u= DB::table('standart_tb_u')->where('umur_bulan',$umuranak )->where('jk',$jk)->first();
    
        if($tb_u){
            if( ($tb_u->plus_2_sd <= $i_tb) && ($i_tb <= $tb_u->plus_3_sd)){
                $status_tb ='Tinggi';
            }else if(($tb_u->plus_1_sd <= $i_tb) && ($i_tb <= $tb_u->plus_2_sd)){
                $status_tb ='Normal';
            }elseif(($tb_u->median <= $i_tb) && ($i_tb <= $tb_u->plus_1_sd)){
                $status_tb = 'Normal';
            }elseif(($tb_u->min_1_sd <= $i_tb) && ($i_tb <= $tb_u->median)){
                $status_tb = 'Normal';
            }
            elseif(($tb_u->min_2_sd <= $i_tb) && ($i_tb <= $tb_u->min_1_sd)){
                $status_tb = 'Normal';
            }
            elseif(($tb_u->min_3_sd <= $i_tb) && ($i_tb <= $tb_u->min_2_sd)){
                $status_tb = 'Pendek';
            }else{
                $status_tb ='Sangat Pendek';
            }
        }else{
            $status_tb ='data tidak tersedia';
        }
        // return $tb_u;
       
        // return $status_tb;


        $i_bb=$request->berat_badan;
        $status_bb='';
        
        $bb_u= DB::table('standart_bb_u')->where('umur_bulan',$umuranak )->where('jk',$jk)->first();
        // return $bb_u;
        if( ( $i_bb >= $bb_u->plus_3_sd )){
            $status_bb ='Obesitas';
        }else if(($i_bb >= $bb_u->plus_2_sd) && ($i_bb <= $bb_u->plus_3_sd)){
            $status_bb ='Obesitas';
        }elseif(($i_bb >= $bb_u->plus_1_sd) && ($i_bb <= $bb_u->plus_2_sd)){
            $status_bb = 'Resiko BB lebih';
        }elseif(($i_bb >= $bb_u->median) && ($i_bb <= $bb_u->plus_1_sd)){
            $status_bb = 'Normal';
        }elseif(($i_bb >= $bb_u->min_1_sd) && ($i_bb <= $bb_u->median)){
            $status_bb = 'Normal';
        }elseif(($i_bb >= $bb_u->min_2_sd) && ($i_bb <= $bb_u->min_1_sd)){
            $status_bb = 'Normal';
        }
        elseif(($i_bb >= $bb_u->min_3_sd) && ($i_bb <= $bb_u->min_2_sd)){
            $status_bb = 'BB kurang';
        }else{
            $status_bb ='BB sangat kurang';
        }
        // return $status_bb;




        $i_lk=$request->lingkar_kepala;
        $status_lk='';

        $lk_u= DB::table('standart_lk_u')->where('umur_bulan',$umuranak )->where('jk',$jk)->first();
        if($lk_u){
            if( ($lk_u->plus_2_sd <= $i_lk) && ($i_lk <= $lk_u->plus_3_sd)){
                $status_lk ='LK terlalu besar';
            }else if(($lk_u->plus_1_sd <= $i_lk) && ($i_lk <= $lk_u->plus_2_sd)){
                $status_lk ='LK terlalu besar';
            }elseif(($lk_u->median <= $i_lk) && ($i_lk <= $lk_u->plus_1_sd)){
                $status_lk = 'Normal';
            }elseif(($lk_u->min_1_sd <= $i_lk) && ($i_lk <= $lk_u->median)){
                $status_lk = 'Normal';
            }
            elseif(($lk_u->min_2_sd <= $i_lk) && ($i_lk <= $lk_u->min_1_sd)){
                $status_lk = 'Normal';
            }
            elseif(($lk_u->min_3_sd <= $i_lk) && ($i_lk <= $lk_u->min_2_sd)){
                $status_lk ='LK terlalu kecil';
            }else{
                $status_lk ='LK terlalu kecil';
            }
            // return $status_lk;

        }else{
            $status_lk ='data tidak tersedia';
        }
      

        
    $bb_tb = DB::table('standart_bb_tb')->where('jk',$jk)->where('tinggi_badan',$request->tinggi_badan)->first();
        // return $bb_tb;
        $i_bb_tb=$request->berat_badan;
        $status_bb_tb='';

        if($bb_tb){

        //kurang +3sd untuk status gizi obesitas

        if( ($bb_tb->plus_2_sd <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->plus_3_sd)){
            $status_bb_tb ='Gizi lebih';
        }else if(($bb_tb->plus_1_sd <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->plus_2_sd)){
            $status_bb_tb ='Beresiko gizi lebih';  
        }elseif ($bb_tb->plus_3_sd <= $i_bb_tb) {
            $status_bb_tb ='obesitas';          
        }elseif(($bb_tb->median <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->plus_1_sd)){
            $status_bb_tb = 'Gizi baik';
        }elseif(($bb_tb->min_1_sd <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->median)){
            $status_bb_tb = 'Gizi baik';
        }
        elseif(($bb_tb->min_2_sd <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->min_1_sd)){
            $status_bb_tb = 'Gizi baik';
        }
        elseif(($bb_tb->min_3_sd <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->min_2_sd)){
            $status_bb_tb ='Gizi kurang';
        }else{
            $status_bb_tb ='Gizi Buruk';
        }

        // return $status_bb_tb;
    }else{
        $status_bb_tb ='data tidak tersedia';
    }


          
        $imt_u = DB::table('standart_imt_u')->where('umur_bulan',$umuranak )->where('jk',$jk)->first();
        // return $bb_tb;

        $tinggi = $request->tinggi_badan*100;
        $imt_us = $request->berat_badan/($tinggi*$tinggi);
        $i_imt_u=$imt_us;
        $status_imt_u='';

        //kurang pembacaan status gizi obesiteas +3sd

        if( ($imt_u->plus_2_sd <= $i_imt_u) && ($i_imt_u <= $imt_u->plus_3_sd)){
            $status_imt_u ='Gizi lebih';
        }elseif($imt_u->plus_3_sd <= $i_imt_u) {
            $status_bb_tb ='Obesitas';
        }else if(($imt_u->plus_1_sd <= $i_imt_u) && ($i_imt_u <= $imt_u->plus_2_sd)){
            $status_imt_u ='Resiko gizi lebih';
        }elseif(($imt_u->median <= $i_imt_u) && ($i_imt_u <= $imt_u->plus_1_sd)){
            $status_imt_u = 'Gizi baik';
        }elseif(($imt_u->min_1_sd <= $i_imt_u) && ($i_imt_u <= $imt_u->median)){
            $status_imt_u = 'Gizi baik';
        }
        elseif(($imt_u->min_2_sd <= $i_imt_u) && ($i_imt_u <= $imt_u->min_1_sd)){
            $status_imt_u = 'Gizi baik';
        }
        elseif(($imt_u->min_3_sd <= $i_imt_u) && ($i_imt_u <= $imt_u->min_2_sd)){
            $status_imt_u ='Gizi kurang';
        }else{
            $status_imt_u ='Gizi buruk';
        }
        // return $status_imt_u;

      
      

  

        
        $data_baru = Penimbangan::create([
            'nik_anak'=>$request->nik_anak,
            'berat_badan'=>$request->berat_badan,
            'tinggi_badan'=>$request->tinggi_badan,
            'lingkar_kepala'=>$request->lingkar_kepala,
            'status_tb_u'=>$status_tb,
            'status_bb_u'=>$status_bb,
            'status_lk_u'=>$status_lk,
            'status_imt_u'=>$status_imt_u,
            'status_bb_tb'=>$status_bb_tb,
          
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

    
    public function cekumur($tanggal_lahir)
    {
        $bulan =  Carbon::parse($tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%m');
        $tahun =  Carbon::parse($tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y');
        return $tahun*12+$bulan;
    }
}
