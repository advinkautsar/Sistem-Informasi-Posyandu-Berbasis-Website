<?php

namespace App\Http\Controllers\WEB\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekapitulasiAnakController extends Controller
{
    //
    public function index(){
        return view('admin.rekapitulasi');
    }
}
