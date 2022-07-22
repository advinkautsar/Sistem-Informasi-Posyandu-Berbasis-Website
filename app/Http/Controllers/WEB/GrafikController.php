<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class GrafikController extends Controller
{

    public function index($kode,$id)
    {
        $penimbangan = DB::table('penimbangan')
        ->join("anak", "anak.nik_anak", "=", "penimbangan.nik_anak")
        ->where("penimbangan.id", $id)
        ->first();
        if(!$penimbangan){
            return "Data tidak ditemukan";
        }
        $umur = $this->cekumur($penimbangan->tanggal_lahir);
        $berat_badan = $penimbangan->berat_badan;
        $tinggi_badan = $penimbangan->tinggi_badan;
        $lingkar_kepala = $penimbangan->lingkar_kepala;
        $imt = $berat_badan / ($tinggi_badan * $tinggi_badan);

        $jenis="";
        $nama_grafik="";
        $berdasarkanX=0;
        $berdasarkanY=0;
        $titleX="0";
        $titleY="0";

        switch ($kode) {
            case 'standart_bb_pb':
                $jenis = "panjang_badan";
                $nama_grafik = "Berat Badan Menurut Panjang Badan";
                $berdasarkanY = $berat_badan;
                $berdasarkanX = $tinggi_badan;
                $titleX = "Panjang Badan (cm)";
                $titleY = "Berat Badan (kg)";
                break;
            case 'standart_bb_tb':
                $jenis = "tinggi_badan";
                $nama_grafik = "Berat Badan Menurut Tinggi Badan";
                $berdasarkanY = $berat_badan;
                $berdasarkanX = $tinggi_badan;
                $titleX = "Tinggi Badan (cm)";
                $titleY = "Berat Badan (kg)";
                break;
            case 'standart_bb_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Berat Badan Menurut Umur";
                $berdasarkanY = $berat_badan;
                $berdasarkanX = $umur;
                $titleX = "Umur (Bulan)";
                $titleY = "Berat Badan (kg)";
                break;
            case 'standart_imt_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Index Massa Tubuh Menurut Umur";
                $berdasarkanY = $imt;
                $berdasarkanX = $umur;
                $titleX = "Umur (Bulan)";
                $titleY = "Index Massa Tubuh (IMT)";
                break;
            case 'standart_lk_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Lingkar Kepala Badan Menurut Umur";
                $berdasarkanY = $lingkar_kepala;
                $berdasarkanX = $umur;
                $titleX = "Umur (Bulan)";
                $titleY = "Lingkar Kepala (cm)";
                break;
            case 'standart_pb_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Panjang Badan Menurut Umur";
                $berdasarkanY = $tinggi_badan;
                $berdasarkanX = $umur;
                $titleX = "Umur (Bulan)";
                $titleY = "Panjang Badan (cm)";
                break;
            case 'standart_tb_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Tinggi Badan Menurut Tinggi Umur";
                $berdasarkanY = $tinggi_badan;
                $berdasarkanX = $umur;
                $titleX = "Umur (Bulan)";
                $titleY = "Tinggi Badan (cm)";
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
            "berdasarkanX" => $berdasarkanX,
            "berdasarkanY" => $berdasarkanY,
            "titleX" => $titleX,
            "titleY" => $titleY,
        ];
        return view('grafik.index',compact("data","setingan","nama_grafik"));
    }


    public function penimbangan_all($kode,$id)
    {
        $penimbangan = DB::table('penimbangan')
        ->join("anak", "anak.nik_anak", "=", "penimbangan.nik_anak")
        ->where("penimbangan.nik_anak", $id)
        ->get();
        if($penimbangan->isEmpty()){
            return "Data tidak ditemukan";
        }

        
        $umur = array();
        $berat_badan = array();
        $tinggi_badan = array();
        $lingkar_kepala = array();
        $imt = array();

        
        foreach($penimbangan as $p){
            array_push($umur,$this->cekumur($p->tanggal_lahir));
            array_push($berat_badan,$p->berat_badan);
            array_push($tinggi_badan,$p->tinggi_badan);
            array_push($lingkar_kepala,$p->lingkar_kepala);
            array_push($imt,$p->berat_badan / ($p->tinggi_badan * $p->tinggi_badan));
        }
        

        $jenis="";
        $nama_grafik="";
        $berdasarkanX=0;
        $berdasarkanY=0;
        $titleX="0";
        $titleY="0";

        switch ($kode) {
            case 'standart_bb_pb':
                $jenis = "panjang_badan";
                $nama_grafik = "Berat Badan Menurut Panjang Badan";
                $berdasarkanY = $berat_badan;
                $berdasarkanX = $tinggi_badan;
                $titleX = "Panjang Badan (cm)";
                $titleY = "Berat Badan (kg)";
                break;
            case 'standart_bb_tb':
                $jenis = "tinggi_badan";
                $nama_grafik = "Berat Badan Menurut Tinggi Badan";
                $berdasarkanY = $berat_badan;
                $berdasarkanX = $tinggi_badan;
                $titleX = "Tinggi Badan (cm)";
                $titleY = "Berat Badan (kg)";
                break;
            case 'standart_bb_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Berat Badan Menurut Umur";
                $berdasarkanY = $berat_badan;
                $berdasarkanX = $umur;
                $titleX = "Umur (Bulan)";
                $titleY = "Berat Badan (kg)";
                break;
            case 'standart_imt_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Index Massa Tubuh Menurut Umur";
                $berdasarkanY = $imt;
                $berdasarkanX = $umur;
                $titleX = "Umur (Bulan)";
                $titleY = "Index Massa Tubuh (IMT)";
                break;
            case 'standart_lk_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Lingkar Kepala Badan Menurut Umur";
                $berdasarkanY = $lingkar_kepala;
                $berdasarkanX = $umur;
                $titleX = "Umur (Bulan)";
                $titleY = "Lingkar Kepala (cm)";
                break;
            case 'standart_pb_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Panjang Badan Menurut Umur";
                $berdasarkanY = $tinggi_badan;
                $berdasarkanX = $umur;
                $titleX = "Umur (Bulan)";
                $titleY = "Panjang Badan (cm)";
                break;
            case 'standart_tb_u':
                $jenis = "umur_bulan";
                $nama_grafik = "Tinggi Badan Menurut Tinggi Umur";
                $berdasarkanY = $tinggi_badan;
                $berdasarkanX = $umur;
                $titleX = "Umur (Bulan)";
                $titleY = "Tinggi Badan (cm)";
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
            "berdasarkanX" => $berdasarkanX,
            "berdasarkanY" => $berdasarkanY,
            "titleX" => $titleX,
            "titleY" => $titleY,
        ];
        return view('grafik.penimbanganall',compact("data","setingan","nama_grafik"));
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

    public function cekumur($tgl_lahir)
    {
        $now = Carbon::now();
        $b_day = Carbon::parse($tgl_lahir);
        $umur = $b_day->diff($now)->m;
        return $umur;
    }
}