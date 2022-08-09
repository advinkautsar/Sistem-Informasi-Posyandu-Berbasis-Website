<?php

namespace App\Http\Controllers\WEB\PetugasDesa;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_user = auth()->user()->petugas_desa->desa_kelurahan_id;
        
        $jumlah_anak = DB::table('anak')
        ->join('orangtua','anak.orangtua_id','orangtua.id')
        ->select('anak.*','orangtua.*')
        ->where('desa_kelurahan_id',$data_user)
        ->count();

        $jumlah_ortu = DB::table('orangtua')
        ->where('desa_kelurahan_id',$data_user)
        ->count();

        $jumlah_bidan = DB::table('bidan')
        ->join('posyandu','bidan.posyandu_id','posyandu.id')
        ->select('bidan.*','posyandu.*')
        ->where('desa_kelurahan_id',$data_user)
        ->count();

        $jumlah_kader = DB::table('kader')
        ->join('posyandu','kader.posyandu_id','posyandu.id')
        ->select('kader.*','posyandu.*')
        ->where('desa_kelurahan_id',$data_user)
        ->count();
        
        $data_pos = DB::table('posyandu')
        ->join('desa_kelurahan','posyandu.desa_kelurahan_id','desa_kelurahan.id')
        ->select('posyandu.*','desa_kelurahan.nama')
        ->where('desa_kelurahan_id', $data_user)
        ->get();

        $data_anak = Anak::all();

        return view('petugas_desa.dashboard', compact(['data_pos', 'data_anak','jumlah_anak','jumlah_ortu','jumlah_bidan','jumlah_kader']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
