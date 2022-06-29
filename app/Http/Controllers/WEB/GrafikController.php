<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GrafikController extends Controller
{

    public function index($kode)
    {
        $jenis="";
        $nama_grafik="";
        switch ($kode) {
            case 'standart_bb_pb':
                $jenis = "panjang_badan";
                $nama_grafik = "Berat Badan Menurut Panjang Badan";
                break;
            case 'standart_bb_tb':
                $jenis = "tinggi_badan";
                $nama_grafik = "Berat Badan Menurut Tinggi Badan";
                break;
            case 'standart_bb_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Berat Badan Menurut Umur";
                break;
            case 'standart_imt_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Index Massa Tubuh Menurut Umur";
                break;
            case 'standart_lk_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Lingkar Kepala Badan Menurut Umur";
                break;
            case 'standart_pb_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Panjang Badan Menurut Umur";
                break;
            case 'standart_tb_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Tinggi Badan Menurut Tinggi Umur";
                break;
            default:
                return "Grafik Tidak Ditemukan";
                break;
        }
        $standart = DB::table($kode)
        ->where("jk","Perempuan")
        ->get();
        $data = $this->pushToData($standart,$jenis);
        $setingan = [
            "maxx"=> $jenis == "panjang_badan" || $jenis == "tinggi_badan" ?  floor($standart->count()/10) : "",
            "maxy" => ceil($standart->max("plus_3_sd")) % 2 != 0 ? ceil($standart->max("plus_3_sd")) + 1 : ceil($standart->max("plus_3_sd")),
        ];
        return view('grafik.index',compact("data","setingan","nama_grafik"));
    }

    function pushToData($getdata,$judul){
        $data = [
            "label" => array(),
            'min_3_sd' => array(),
            'min_2_sd' => array(),
            'min_1_sd' => array(),
            'median' => array(),
            'plus_1_sd' => array(),
            'plus_2_sd' => array(),
            'plus_3_sd' => array(),
        ];
        foreach ($getdata as  $value) {
                array_push($data["label"], $value->$judul);
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