<?php

namespace App\Http\Controllers\WEB\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Kecamatan;
use App\Models\Orangtua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $data_kecamatan = Kecamatan::all();

        return view('admin.dashboard', compact(['data_kecamatan']));
    }

    public function rekap_desa($id)
    {
        $data_desa = DB::table('desa_kelurahan')
        ->where('kecamatan_id',$id)
        ->get();

        // return $data_desa;

        return view('admin.rekap_desa', compact(['data_desa']));
    }

    public function rekap_posyandu($id)
    {
        $data_pos = DB::table('posyandu')
        ->join('desa_kelurahan','posyandu.desa_kelurahan_id','desa_kelurahan.id')
        ->select('posyandu.*','desa_kelurahan.nama')
        ->where('desa_kelurahan_id',$id)
        ->get();
       

        foreach ($data_pos as $key => $value) {
            $data_pos[$key]->orangtua =
                Orangtua::where('posyandu_id', $value->id)->with(
            ['anaks.penimbangans'
            => function ($q)  {
                $q->select("*", DB::raw('YEAR(created_at) year, MONTH(created_at) bulan'));
            }
            ]
        )->get();

        foreach ($data_pos[$key]->orangtua as $Orangtua) {
        
            if (!$Orangtua->anaks->isEmpty()) {
                foreach ($Orangtua->anaks as $anak) {
                    // $umuranak = $this->cekumur($anak->tanggal_lahir);
                    // if ($umuranak > 0 && $umuranak <= 24) {
                    
                        if (!$anak->penimbangans->isEmpty()) {
                            foreach ($anak->penimbangans as $penimbangan) {
                                // return $penimbangan->orderBy('id','desc')->first();

                                $p = $penimbangan->select(
                                    DB::raw('count(id) as `jumlah`'),
                                    )->where('status_bb_pb','Gizi Buruk')->limit(1)
                                   
                                    
                                    // DB::raw("tanggal_kursus","id_jam"),
                                    // DB::raw("id_jam as jam_kursus" ),)
                                    // ->groupBy(['tanggal_kursus','id_jam'])->orderBy('tanggal_kursus')
                                    ->get();
                                    return $p;
                              
                            }
                        // }
                    
                    }
                }
            }
        }



        

          


        }
        return $data_pos;

    
        // $ortu = Orangtua::where('posyandu_id',$id)->get();
        // foreach ($ortu as $key => $value) {
        //     // $ortu[$key]->jumlah_anak = DB::table('anak')
        //     // ->where('orangtua_id',$value->id)
        //     // ->count();
        //     $anak = Anak::where('orangtua_id',$value->id)->get();
        //     // $isi_anak = $anak;
          
        // }
        // return $anak;

        // // return $ortu->anak;

        // return $data_pos;

        // $ortu = Orangtua::where('posyandu_id', $data_pos->id)->with(
        //     ['anaks.penimbangans'
        //     => function ($q)  {
        //         $q->select("*", DB::raw('YEAR(created_at) year, MONTH(created_at) bulan'));
        //         // $q->orderBy('id', 'desc')->first();
              
              
        //     }]
        // )->get();

     

        // return $ortu;

        return view('admin.rekap_posyandu', compact('data_pos'));
    }
}
