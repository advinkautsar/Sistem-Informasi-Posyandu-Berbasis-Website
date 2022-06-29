<?php

namespace App\Http\Controllers\WEB\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Penimbangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrafikAnakController extends Controller
{
    //
    public function index(){

        $anak = Anak::where('');
        // $i=89.9;
        // $status='';

        
        // $tb_u= DB::table('standart_tb_u')->where('umur_bulan','36')->where('jk','laki-laki')->first();
        // // return $tb_u;
        // if( ($tb_u->plus_2_sd <= $i) && ($i <= $tb_u->plus_3_sd)){
        //     $status ='tinggi';
        // }else if(($tb_u->plus_1_sd <= $i) && ($i <= $tb_u->plus_2_sd)){
        //     $status ='normal 1';
        // }elseif(($tb_u->median <= $i) && ($i <= $tb_u->plus_1_sd)){
        //     $status = 'normal2';
        // }elseif(($tb_u->min_1_sd <= $i) && ($i <= $tb_u->median)){
        //     $status = 'normal3';
        // }
        // elseif(($tb_u->min_2_sd <= $i) && ($i <= $tb_u->min_1_sd)){
        //     $status = 'normal4';
        // }
        // elseif(($tb_u->min_3_sd <= $i) && ($i <= $tb_u->min_2_sd)){
        //     $status = 'pendek';
        // }else{
        //     $status ='sangat pendek';
        // }
        // return $status;

        //bb_umur

        // $i=8;
        // $status='';
        
        // $bb_u= DB::table('standart_bb_u')->where('umur_bulan','4')->where('jk','laki-laki')->first();
        // // return $bb_u;
        // if( ( $i >= $bb_u->plus_3_sd )){
        //     $status ='obesitas';
        // }else if(($i >= $bb_u->plus_2_sd) && ($i <= $bb_u->plus_3_sd)){
        //     $status ='obesitas0';
        // }elseif(($i >= $bb_u->plus_1_sd) && ($i <= $bb_u->plus_2_sd)){
        //     $status = 'gemuk';
        // }elseif(($i >= $bb_u->median) && ($i <= $bb_u->plus_1_sd)){
        //     $status = 'normal3';
        // }elseif(($i >= $bb_u->min_1_sd) && ($i <= $bb_u->median)){
        //     $status = 'normal2';
        // }elseif(($i >= $bb_u->min_2_sd) && ($i <= $bb_u->min_1_sd)){
        //     $status = 'normal1';
        // }
        // elseif(($i >= $bb_u->min_3_sd) && ($i <= $bb_u->min_2_sd)){
        //     $status = 'kurus';
        // }else{
        //     $status ='sangat kurus';
        // }
        // return $status;

        //  $i=48;
        // $status='';

        // $lk_u= DB::table('standart_lk_u')->where('umur_bulan','36')->where('jk','laki-laki')->first();
        // if( ($lk_u->plus_2_sd <= $i) && ($i <= $lk_u->plus_3_sd)){
        //     $status ='lebih dr normal';
        // }else if(($lk_u->plus_1_sd <= $i) && ($i <= $lk_u->plus_2_sd)){
        //     $status ='lebih dr normal';
        // }elseif(($lk_u->median <= $i) && ($i <= $lk_u->plus_1_sd)){
        //     $status = 'normal2';
        // }elseif(($lk_u->min_1_sd <= $i) && ($i <= $lk_u->median)){
        //     $status = 'normal3';
        // }
        // elseif(($lk_u->min_2_sd <= $i) && ($i <= $lk_u->min_1_sd)){
        //     $status = 'normal4';
        // }
        // elseif(($lk_u->min_3_sd <= $i) && ($i <= $lk_u->min_2_sd)){
        //     $status ='lingkar kepala kurang dari normal';
        // }else{
        //     $status ='lingkar kepala kurang dari normal';
        // }
        // return $status;

        // $bb_tb = DB::table('standart_bb_tb')->where('jk','laki-laki')->where('umur')->first();
        // $i_bb_tb = $request
        // return $bb_tb;
        // if()
        // $usia = DB::table('anak')->where('nik_anak','3510210102990011')->first();
        // $usia->umur_bulan = Carbon::parse($usia->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%m');
        // return $usia->umur_bulan;

        // $bb_tb = DB::table('standart_bb_tb')->where('jk','laki-laki')->where('tinggi_badan',70)->first();
        
        // // return $bb_tb;
        // $i_bb_tb=67;
        // $status_bb_tb='';
        // if( ($bb_tb->plus_2_sd <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->plus_3_sd)){
        //     $status_bb_tb ='gemuk';
        // }else if(($bb_tb->plus_1_sd <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->plus_2_sd)){
        //     $status_bb_tb ='normal 1';  
        // }elseif(($bb_tb->median <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->plus_1_sd)){
        //     $status_bb_tb = 'normal2';
        // }elseif(($bb_tb->min_1_sd <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->median)){
        //     $status_bb_tb = 'normal3';
        // }
        // elseif(($bb_tb->min_2_sd <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->min_1_sd)){
        //     $status_bb_tb = 'normal4';
        // }
        // elseif(($bb_tb->min_3_sd <= $i_bb_tb) && ($i_bb_tb <= $bb_tb->min_2_sd)){
        //     $status_bb_tb ='kurus';
        // }else{
        //     $status_bb_tb ='kurus';
        // }

        // return $status_bb_tb;


           $usia = DB::table('anak')->where('nik_anak','3510210102990011')->first();
        $usia->umur_bulan = Carbon::parse($usia->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%m');
        // return $usia->umur_bulan;

        $imt_u = DB::table('standart_imt_u')->where('jk','laki-laki')->where('umur_bulan',$usia->umur_bulan)->first();
        // return $bb_tb;

        $tinggi = 66.5*100;

        $imt_us = 38/($tinggi*$tinggi);
        $i_imt_u=$imt_us;
            
      
        $status_imt_u='';

        if( ($imt_u->plus_2_sd <= $i_imt_u) && ($i_imt_u <= $imt_u->plus_3_sd)){
            $status_imt_u ='obesitas';
        }else if(($imt_u->plus_1_sd <= $i_imt_u) && ($i_imt_u <= $imt_u->plus_2_sd)){
            $status_imt_u ='obesitas';
        }elseif(($imt_u->median <= $i_imt_u) && ($i_imt_u <= $imt_u->plus_1_sd)){
            $status_imt_u = 'normal1';
        }elseif(($imt_u->min_1_sd <= $i_imt_u) && ($i_imt_u <= $imt_u->median)){
            $status_imt_u = 'normal2';
        }
        elseif(($imt_u->min_2_sd <= $i_imt_u) && ($i_imt_u <= $imt_u->min_1_sd)){
            $status_imt_u = 'normal3';
        }
        elseif(($imt_u->min_3_sd <= $i_imt_u) && ($i_imt_u <= $imt_u->min_2_sd)){
            $status_imt_u ='kurus';
        }else{
            $status_imt_u ='kurus';
        }
        return $status_imt_u;

      



     

        $penimbangan = DB::table('penimbangan')->join('anak', 'penimbangan.nik_anak', '=', 'anak.nik_anak')->get();


        return view('admin.grafikanak',compact('penimbangan'));
    }
    public function getumur(){
        // $penimbangan = DB::table('penimbangan')->join('anak', 'penimbangan.nik_anak', '=', 'anak.nik_anak')->get();
        // foreach($penimbangan as $p){
        //     $p->umur = Carbon::parse($p->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days');
        //     $p->umur_bulan = Carbon::parse($p->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%m months');
        // }
        // return $penimbangan;

       $tb_u= DB::table('standard_tb_u')->get();
       return $tb_u;

    }
}
