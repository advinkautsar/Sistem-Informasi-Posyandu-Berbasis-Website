<?php

namespace App\Http\Controllers\WEB\PetugasPuskesmas;

use App\Http\Controllers\Controller;
use App\Models\Bidan;
use App\Models\Posyandu;
use App\Models\Puskesmas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BidanCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_petpus = auth()->user()->petugas_puskesmas->puskesmas->id;
        // $data_bidan = DB::table('bidan')
        // ->join('puskesmas','bidan.puskesmas_id','puskesmas.id')
        // ->select('bidan.*','puskesmas.nama_puskesmas')
        // ->where('puskesmas_id', $user_petpus)
        // ->get();

        $data_bidan = DB::table('user')
        ->join('bidan','user_id','user.id')
        ->join('puskesmas','bidan.puskesmas_id','puskesmas.id')
        ->select('user.*','bidan.nama_bidan','bidan.puskesmas_id','bidan.posyandu_id','bidan.alamat','puskesmas.nama_puskesmas')
        ->where('role','=','bidan')
        ->where('puskesmas_id','=', $user_petpus)
        ->get();

      
        
        // return $data_bidan;
        return view('petugas_puskesmas.bidan.index', compact(['data_bidan']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_petpus = auth()->user()->petugas_puskesmas->puskesmas->id;

        $data_pus = Puskesmas::all();

        $data_pos = DB::table('posyandu')
        ->join('desa_kelurahan', 'posyandu.desa_kelurahan_id', '=', 'desa_kelurahan.id')
        ->select('posyandu.*', 'desa_kelurahan.nama')
        ->where('puskesmas_id','=', $user_petpus)
        ->get();

        return view('petugas_puskesmas.bidan.create',compact('data_pos','data_pus'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required',
            'role' => 'required',
            'nama_bidan' => 'required',
            'alamat'=>'required',
            'posyandu_id' => 'required',
            'puskesmas_id' => 'required',
            
        ]);

        $create_akun = User::create([
            'nama_pengguna'=>$request->nama_pengguna,
            'password'=>bcrypt($request->password),
            'no_hp'=>$request->no_hp,
            'role'=>$request->role,
        ]);

        $create_bidan = Bidan::create([
            'nama_bidan'=>$request->nama_bidan,
            'alamat'=>$request->alamat,
            'posyandu_id'=>$request->posyandu_id,
            'puskesmas_id'=>$request->puskesmas_id,
            'user_id'=>$create_akun->id,
        ]);

        if ($create_akun || $create_bidan) {
            return redirect()->route('bidan.index')->with('succes', 'Data Bidan Telah Terdaftar');
        } else {
            return redirect()->route('bidan.index')->with('fail', 'Ups!! ada sesuatu yang bermasalah, coba sesaat lagi !');
        }
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
        $user_petpus = auth()->user()->petugas_puskesmas->puskesmas->id;

        $data_bidan = DB::table('user')
        ->join('bidan','user_id','user.id')
        ->join('puskesmas','bidan.puskesmas_id','puskesmas.id')
        ->select('user.*','bidan.nama_bidan','bidan.puskesmas_id','bidan.posyandu_id','bidan.alamat','puskesmas.nama_puskesmas')
        ->where('user.id', $id)
        ->first();
        

        $data_pus = Puskesmas::all();

        $data_pos = DB::table('posyandu')
        ->join('desa_kelurahan', 'posyandu.desa_kelurahan_id', '=', 'desa_kelurahan.id')
        ->select('posyandu.*', 'desa_kelurahan.nama')
        ->where('puskesmas_id','=', $user_petpus)
        ->get();

        // return $data_bidan;

        return view('petugas_puskesmas.bidan.edit',compact('data_pos','data_pus','data_bidan'));
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
        $request->validate([
            'nama_pengguna' => 'required',
            'role' => 'required',
            'nama_bidan' => 'required',
            'alamat'=>'required',
            'posyandu_id' => 'required',
            'puskesmas_id' => 'required',
            
        ]);

        $data_user = User::find($id);
        $update_akun = $data_user->update([
            'nama_pengguna'=>$request->nama_pengguna,
            'password'=>bcrypt($request->password),
            'no_hp'=>$request->no_hp,
            'role'=>$request->role,
        ]);

        $data_bidan = Bidan::where('user_id', $id)->first();
        $update_petbid = $data_bidan->update([
            'nama_bidan'=>$request->nama_bidan,
            'alamat'=>$request->alamat,
            'posyandu_id'=>$request->posyandu_id,
            'puskesmas_id'=>$request->puskesmas_id,
        ]);
        
        // return $data_user;

        if ($update_akun || $update_petbid) {
            return redirect()->route('bidan.index')->with('succes', 'Akun berhasil di edit');
        } else {
            return redirect()->route('bidan.index')->with('fail', 'Ups!! ada sesuatu yang bermasalah, coba sesaat lagi !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        $del = User::find($id);

        $del->delete();
        return redirect()->route('bidan.index')->with('berhasil', 'Data Bidan berhasil di hapus');
    }
}
