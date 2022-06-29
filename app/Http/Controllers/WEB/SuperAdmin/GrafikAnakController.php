<?php

namespace App\Http\Controllers\WEB\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Penimbangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrafikAnakController extends Controller
{
    //
    public function index(){
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

        $i=8;
        $status='';
        
        $bb_u= DB::table('standart_bb_u')->where('umur_bulan','4')->where('jk','laki-laki')->first();
        // return $bb_u;
        if( ( $i >= $bb_u->plus_3_sd )){
            $status ='obesitas';
        }else if(($i >= $bb_u->plus_2_sd) && ($i <= $bb_u->plus_3_sd)){
            $status ='obesitas0';
        }elseif(($i >= $bb_u->plus_1_sd) && ($i <= $bb_u->plus_2_sd)){
            $status = 'gemuk';
        }elseif(($i >= $bb_u->median) && ($i <= $bb_u->plus_1_sd)){
            $status = 'normal3';
        }elseif(($i >= $bb_u->min_1_sd) && ($i <= $bb_u->median)){
            $status = 'normal2';
        }elseif(($i >= $bb_u->min_2_sd) && ($i <= $bb_u->min_1_sd)){
            $status = 'normal1';
        }
        elseif(($i >= $bb_u->min_3_sd) && ($i <= $bb_u->min_2_sd)){
            $status = 'kurus';
        }else{
            $status ='sangat kurus';
        }
        return $status;
     
     

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
