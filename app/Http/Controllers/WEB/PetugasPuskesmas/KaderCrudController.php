<?php

namespace App\Http\Controllers\WEB\PetugasPuskesmas;

use App\Http\Controllers\Controller;
use App\Models\Kader;
use App\Models\Posyandu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaderCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_petpus = auth()->user()->petugas_puskesmas->puskesmas->id;

        $data_kader = DB::table('user')
        ->join('kader','user_id','user.id')
        ->join('posyandu','kader.posyandu_id','posyandu.id')
        ->select('user.*','kader.nama_kader','kader.alamat','kader.posyandu_id','posyandu.puskesmas_id','posyandu.nama_posyandu')
        ->where('role','=','kader')
        ->where('puskesmas_id','=', $user_petpus)
        ->get();

        // dd($data_kader);

        // return $data_kader;
        return view('petugas_puskesmas.kader.index', compact(['data_kader']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user_petpus = auth()->user()->petugas_puskesmas->puskesmas->id;
        $data_pos = DB::table('posyandu')
        ->join('desa_kelurahan', 'posyandu.desa_kelurahan_id', '=', 'desa_kelurahan.id')
        ->select('posyandu.*', 'desa_kelurahan.nama')
        ->where('puskesmas_id','=', $user_petpus)
        ->get();


        return view('petugas_puskesmas.kader.create', compact(['data_pos']));
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
            'nama_kader' => 'required',
            'alamat'=>'required',
            'posyandu_id' => 'required',
            
        ]);

        $create_akun = User::create([
            'nama_pengguna'=>$request->nama_pengguna,
            'password'=>bcrypt($request->password),
            'no_hp'=>$request->no_hp,
            'role'=>$request->role,
        ]);

        $create_kader = Kader::create([
            'nama_kader'=>$request->nama_kader,
            'alamat'=>$request->alamat,
            'posyandu_id'=>$request->posyandu_id,
            'user_id'=>$create_akun->id,
        ]);

        if ($create_akun || $create_kader) {
            return redirect()->route('kader.index')->with('succes', 'Data Kader Telah Terdaftar');
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
       
        $data_kader = DB::table('user')
        ->join('kader','user_id','user.id')
        ->join('posyandu','kader.posyandu_id','posyandu.id')
        ->select('user.*','kader.nama_kader','kader.alamat','kader.posyandu_id','posyandu.nama_posyandu')
        ->where('user.id', $id)
        ->first();

        $data_pos = DB::table('posyandu')
        ->join('desa_kelurahan', 'posyandu.desa_kelurahan_id', '=', 'desa_kelurahan.id')
        ->select('posyandu.*', 'desa_kelurahan.nama')
        ->where('puskesmas_id','=', $user_petpus)
        ->get();

        // return $data_kader;

        return view('petugas_puskesmas.kader.edit',compact('data_pos','data_kader'));
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
            'nama_kader' => 'required',
            'alamat'=>'required',
            'posyandu_id' => 'required',
            
        ]);

        $data_user = User::find($id);
        $update_akun = $data_user->update([
            'nama_pengguna'=>$request->nama_pengguna,
            'password'=>bcrypt($request->password),
            'no_hp'=>$request->no_hp,
            'role'=>$request->role,
        ]);

        $data_kader = Kader::where('user_id', $id)->first();
        $update_petkader = $data_kader->update([
            'nama_kader'=>$request->nama_kader,
            'alamat'=>$request->alamat,
            'posyandu_id'=>$request->posyandu_id,
        ]);
        
        // return $data_user;

        if ($update_akun || $update_petkader) {
            return redirect()->route('kader.index')->with('succes', 'Akun berhasil di edit');
        } else {
            return redirect()->route('kader.index')->with('fail', 'Ups!! ada sesuatu yang bermasalah, coba sesaat lagi !');
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

        return redirect()->route('kader.index')->with('berhasil', 'Data Kader berhasil di hapus');
    }
}
