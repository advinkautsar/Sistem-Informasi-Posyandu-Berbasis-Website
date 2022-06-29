<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GrafikController extends Controller
{

    public function bb_pb()
    {
        $standart_bb_pb = DB::table('standart_bb_pb')
        ->where("jk","Perempuan")
        ->get();
        $data = $this->pushToData($standart_bb_pb,"panjang_badan");
       
        return view('grafik.bb_pb',compact("data"));
    }

    public function bb_tb(){

    }

    public function bb_u(){

    }

    public function imt_u(){

    }
    public function lk_u()
    {
    }
    public function pb_u()
    {
    }

    public function tb_u()
    {

    }

    function pushToData($getdata,$judul){
        $data = [
            $judul => array(),
            'min_3_sd' => array(),
            'min_2_sd' => array(),
            'min_1_sd' => array(),
            'median' => array(),
            'plus_1_sd' => array(),
            'plus_2_sd' => array(),
            'plus_3_sd' => array(),
        ];
        foreach ($getdata as  $value) {
                array_push($data[$judul], $value->panjang_badan);
                array_push($data['min_3_sd'], $value->min_3_sd);
                array_push($data['min_2_sd'], $value->min_2_sd);
                array_push($data['min_1_sd'], $value->min_1_sd);
                array_push($data['median'], $value->median);
                array_push($data['plus_1_sd'], $value->plus_1_sd);
                array_push($data['plus_2_sd'], $value->plus_2_sd);
                array_push($data['plus_3_sd'], $value->plus_3_sd);
        }
        return $data;
    }
}