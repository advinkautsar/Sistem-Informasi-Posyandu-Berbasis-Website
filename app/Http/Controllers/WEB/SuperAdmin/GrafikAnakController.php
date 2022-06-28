<?php

namespace App\Http\Controllers\WEB\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Penimbangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrafikAnakController extends Controller
{
    //
    public function index(){

        $penimbangan = DB::table('penimbangan')->join('anak', 'penimbangan.nik_anak', '=', 'anak.nik_anak')->get();


        return view('admin.grafikanak',compact('penimbangan'));
    }
}
