<?php

namespace App\Http\Controllers\WEB\SuperAdmin\Kelola_Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Desa_kelurahan;
use App\Models\Petugas_desa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetdesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_user = DB::table('user')
        ->where('role','=','petugas_desa')
        ->get();

        return view('admin.kelola_pengguna.petugas_desa.index', ['data_user' => $data_user] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_desa = Desa_kelurahan::all();
        return view('admin.kelola_pengguna.petugas_desa.create',['data_desa' => $data_desa] );
        
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
            'password'=>'required',
            'role' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        $create_akun = User::create([
            'nama_pengguna'=>$request->nama_pengguna,
            'password'=>bcrypt($request->password),
            'no_hp'=>$request->no_hp,
            'role'=>$request->role,
        ]);

        $create_petdes = Petugas_desa::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'desa_kelurahan_id'=>$request->desa_kelurahan_id,
            'user_id'=>$create_akun->id,
        ]);

        if ($create_akun || $create_petdes) {
            return redirect()->route('petdes.index')->with('succes', 'Akun Telah Terdaftar');
        } else {
            return redirect()->route('petdes.index')->with('fail', 'Ups!! ada sesuatu yang bermasalah, coba sesaat lagi !');
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
        $data_desa = Desa_kelurahan::all();
        $data_petdes = Petugas_desa::all();
        $data_user = User::find($id);

        // return $data_desa->nama;

        return view('admin.kelola_pengguna.petugas_desa.edit', compact('data_desa','data_petdes','data_user'));
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

        $data_petdes = Petugas_desa::where('user_id', $id)->first();
        $update_petdes = $data_petdes->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'desa_kelurahan_id'=>$request->desa_kelurahan_id,
        ]);

        
        if ($update_akun || $update_petdes) {
            return redirect()->route('petdes.index')->with('succes', 'Akun berhasil di edit');
        } else {
            return redirect()->route('petdes.index')->with('fail', 'Ups!! ada sesuatu yang bermasalah, coba sesaat lagi !');
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
        $data_user->delete();
        
        return redirect()->route('petdes.index')->with('succes', 'Akun berhasil di hapus');
        

    }
}
