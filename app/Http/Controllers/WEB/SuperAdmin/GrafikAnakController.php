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

      $penimbangan = Anak::all();
        // $penimbangan = DB::table('penimbangan')->join('anak', 'penimbangan.nik_anak', '=', 'anak.nik_anak')->get();


        return view('admin.grafikanak',compact('penimbangan'));
    }
   
}
