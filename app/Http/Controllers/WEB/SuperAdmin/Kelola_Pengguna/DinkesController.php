<?php

namespace App\Http\Controllers\WEB\SuperAdmin\Kelola_Pengguna;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DinkesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_user = DB::table('user')
            ->where('role', 'dinas_kesehatan')
            ->get();       

        return view('admin.kelola_pengguna.dinas_kesehatan.index', ['data_user' => $data_user] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kelola_pengguna.dinas_kesehatan.create');
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
            'nama_pengguna' => 'required|unique:user',
            'password' => 'required',
            'role' => 'required'
        ]);

        //memasukkan data kedalam database
        $user = new User();
        $user->nama_pengguna = $request->nama_pengguna;
        $user->password = Hash::make($request->password);
        $user->no_hp = $request->no_hp;
        $user->role = $request->role;
        $save = $user->save();

        if ($save) {
            return back()->with('succes', 'Akun pengguna berhasil terdaftar');
        } else {
            return back()->with('fail', 'Ups!! ada sesuatu yang bermasalah, coba sesaat lagi !');
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
        $data_user = User::find($id);  
        return view('admin.kelola_pengguna.dinas_kesehatan.edit', ['data_user' => $data_user] );
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
            'role' => 'required'
        ]);

        $user = User::find($id);

            $user->nama_pengguna = $request->get('nama_pengguna');
            $user->password= Hash::make ($request->get('password'));
            $user->no_hp = $request->get('no_hp');
            $user->role= $request->get('role');

            $user->save();

        if ($user) {
            return redirect()->route('dinkes.index')->with('succes', 'Akun pengguna berhasil di ubah');
        } else {
            return redirect()->route('dinkes.index')->with('fail', 'Ups!! ada sesuatu yang bermasalah, coba sesaat lagi !');
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
        $user = User::find($id);
        $user->delete();
        return redirect()->route('dinkes.index')->with('berhasil', 'Akun pengguna berhasil di hapus');

    }
}
