<?php

namespace App\Http\Controllers\WEB\SuperAdmin\Kelola_Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Petugas_puskesmas;
use App\Models\Puskesmas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetpusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_user = DB::table('user')
        ->where('role','=','petugas_puskesmas')
        ->get();

        return view('admin.kelola_pengguna.petugas_puskesmas.index', ['data_user' => $data_user] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_pus = Puskesmas::all();
        return view('admin.kelola_pengguna.petugas_puskesmas.create',['data_pus' => $data_pus] );
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
            'password'=>'required',
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        $create_akun = User::create([
            'nama_pengguna'=>$request->nama_pengguna,
            'password'=>bcrypt($request->password),
            'no_hp'=>$request->no_hp,
            'role'=>$request->role,
        ]);

        $create_petpus = Petugas_puskesmas::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'puskesmas_id'=>$request->puskesmas,
            'user_id'=>$create_akun->id,
        ]);

        if ($create_akun || $create_petpus) {
            return redirect()->route('petpus.index')->with('succes', 'Akun Telah Terdaftar');
        } else {
            return redirect()->route('petpus.index')->with('fail', 'Ups!! ada sesuatu yang bermasalah, coba sesaat lagi !');
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
        $data_pus = Puskesmas::all();
        $data_petpus = Petugas_puskesmas::all();
        $data_user = User::find($id);

        return view('admin.kelola_pengguna.petugas_puskesmas.edit', compact('data_pus','data_petpus','data_user'));
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
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        $data_user = User::find($id);
        $update_akun = $data_user->update([
            'nama_pengguna'=>$request->nama_pengguna,
            'password'=>bcrypt($request->password),
            'no_hp'=>$request->no_hp,
            'role'=>$request->role,
        ]);

        $data_petpus = Petugas_puskesmas::where('user_id', $id)->first();
        $update_petpus = $data_petpus->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'puskesmas_id'=>$request->puskesmas_id,
        ]);

        
        if ($update_akun || $update_petpus) {
            return redirect()->route('petpus.index')->with('succes', 'Akun berhasil di edit');
        } else {
            return redirect()->route('petpus.index')->with('fail', 'Ups!! ada sesuatu yang bermasalah, coba sesaat lagi !');
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
        $data_user = User::find($id);
        

        return $data_user;
        
        // return redirect()->route('petpus.index')->with('succes', 'Akun berhasil di hapus');
    }
}
