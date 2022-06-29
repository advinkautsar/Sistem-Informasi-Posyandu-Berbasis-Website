<?php

namespace App\Http\Controllers\WEB\SuperAdmin;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Models\User;
=======
use App\Models\Posyandu;
>>>>>>> 710290a6a294283a2715c2e8e10a41a5b2d7e51d
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapitulasiAnakController extends Controller
{
    //
    public function index(){
        $posyandu = DB::table('posyandu')->join('desa_kelurahan', 'posyandu.desa_kelurahan_id', '=', 'desa_kelurahan.id')->get();
      
        return view('admin.rekapitulasi',compact('posyandu'));
    }
}
