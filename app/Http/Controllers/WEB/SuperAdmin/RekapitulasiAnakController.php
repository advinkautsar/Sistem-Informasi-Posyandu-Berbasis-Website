<?php

namespace App\Http\Controllers\WEB\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapitulasiAnakController extends Controller
{
    //
    public function index(){
        $posyandu = DB::table('posyandu')
        ->join('desa_kelurahan', 'posyandu.desa_kelurahan_id', '=', 'desa_kelurahan.id')->get();
      
        return view('admin.rekapitulasi',compact('posyandu'));
    }
}
