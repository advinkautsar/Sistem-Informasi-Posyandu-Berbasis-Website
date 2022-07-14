<?php

namespace App\Http\Controllers\WEB\PetugasDesa;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Desa_kelurahan;
use App\Models\Orangtua;
use App\Models\Posyandu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilOrtuCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_petpus = auth()->user()->petugas_desa->desa_kelurahan_id;
        $data_ortu = DB::table('user')
        ->join('orangtua','orangtua.user_id','user.id')
        ->select('user.*','orangtua.nama_ibu','orangtua.nik_ibu','orangtua.nama_ayah','orangtua.nik_ayah','orangtua.status_ekonomi','orangtua.alamat','orangtua.desa_kelurahan_id')
        ->where('role','=','orangtua')
        ->where('desa_kelurahan_id',$user_petpus)
        ->get();


        // return $data_ortu;
        return view('petugas_desa.profil_ortu.index', compact(['data_ortu']));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_petdes = auth()->user()->petugas_desa->desa_kelurahan_id;
        $data_desa = Desa_kelurahan::all();

        $data_pos = DB::table('posyandu')
        ->join('desa_kelurahan', 'posyandu.desa_kelurahan_id', '=', 'desa_kelurahan.id')
        ->select('posyandu.*', 'desa_kelurahan.nama')
        ->where('desa_kelurahan_id','=', $user_petdes)
        ->get();

        return view('petugas_desa.profil_ortu.create', compact(['data_pos','data_desa']));
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
            'nama_ibu' => 'required',
            'nik_ibu' => 'required',
            'pendidikan_terakhir_ibu' => 'required',
            'nama_ayah' => 'required',
            'nik_ayah' => 'required',
            'pendidikan_terakhir_ayah' => 'required',
            'alamat'=>'required',
            'rt'=>'required',
            'rw'=>'required',
            'posyandu_id' => 'required',
            'desa_kelurahan_id' => 'required',
            'nama_anak' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'berat_lahir' => 'required',
            'panjang_lahir' => 'required',
            'nik_anak' => 'required',

        ]);

        $create_akun = User::create([
            'nama_pengguna'=>$request->nama_pengguna,
            'password'=>bcrypt($request->password),
            'no_hp'=>$request->no_hp,
            'role'=>$request->role,
        ]);

        $create_ortu = Orangtua::create([
            'nama_ibu'=>$request->nama_ibu,
            'nik_ibu'=>$request->nik_ibu,
            'pendidikan_terakhir_ibu'=>$request->pendidikan_terakhir_ibu,
            'nama_ayah'=>$request->nama_ayah,
            'nik_ayah'=>$request->nik_ayah,
            'pendidikan_terakhir_ayah'=>$request->pendidikan_terakhir_ayah,
            'alamat'=>$request->alamat,
            'rt'=>$request->rt,
            'rw'=>$request->rw,
            'status_persetujuan'=>$request->status_persetujuan,
            'status_ekonomi'=>$request->status_ekonomi,
            'posyandu_id'=>$request->posyandu_id,
            'desa_kelurahan_id'=>$request->desa_kelurahan_id,
            'user_id'=>$create_akun->id,
        ]);

        $create_anak = Anak::create([
            'nik_anak'=>$request->nik_anak,
            'nama_anak'=>$request->nama_anak,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'berat_lahir'=>$request->berat_lahir,
            'panjang_lahir'=>$request->panjang_lahir,
            'orangtua_id'=>$create_ortu->id,
        ]);

        if ($create_akun || $create_ortu || $create_anak) {
            return redirect()->route('kelola_ortu.index')->with('succes', 'Data Orangtua Berhasil Terdaftar');
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
        // $user_petpus = auth()->user()->petugas_desa->desa_kelurahan_id;
        $data_ortu = DB::table('user')
        ->join('orangtua','orangtua.user_id','user.id')
        ->join('desa_kelurahan','orangtua.desa_kelurahan_id','desa_kelurahan.id')
        ->join('posyandu','orangtua.posyandu_id','posyandu.id')
        ->select('user.*','orangtua.*','desa_kelurahan.nama','posyandu.nama_posyandu')
        ->where('user.id',$id)
        ->first();

        $data_anak = DB::table('user')
        ->join('orangtua','orangtua.user_id','user.id')
        ->join('anak','anak.orangtua_id','orangtua.id')
        ->select('user.id','orangtua.id','anak.*')
        ->where('user.id',$id)
        ->get();

        // $data_anak = DB::table('anak')
        // ->where('orangtua_id',$id);

        // return $data_anak;
        return view('petugas_desa.profil_ortu.profil',compact(['data_ortu','data_anak']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_ortu = DB::table('user')
        ->join('orangtua','orangtua.user_id','user.id')
        ->select('user.*','orangtua.nama_ibu','orangtua.nik_ibu','orangtua.pendidikan_terakhir_ibu','orangtua.nama_ayah','orangtua.nik_ayah','orangtua.pendidikan_terakhir_ayah','orangtua.alamat','orangtua.rt','orangtua.rw','orangtua.status_persetujuan','orangtua.status_ekonomi','orangtua.posyandu_id','orangtua.desa_kelurahan_id')
        ->where('user.id',$id)
        ->first();

        $data_pos = Posyandu::all();
        $data_desa = Desa_kelurahan::all();

        // return $data_ortu;

        return view('petugas_desa.profil_ortu.edit', compact(['data_ortu','data_pos','data_desa']));
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
            'nama_ibu' => 'required',
            'nik_ibu' => 'required',
            'pendidikan_terakhir_ibu' => 'required',
            'nama_ayah' => 'required',
            'nik_ayah' => 'required',
            'pendidikan_terakhir_ayah' => 'required',
            'alamat'=>'required',
            'rt'=>'required',
            'rw'=>'required',
            'posyandu_id' => 'required',
            'desa_kelurahan_id' => 'required',
        ]);

        $data_user = User::find($id);
        $update_akun = $data_user->update([
            'nama_pengguna'=>$request->nama_pengguna,
            'password'=>bcrypt($request->password),
            'no_hp'=>$request->no_hp,
            'role'=>$request->role,
        ]);

        $data_ortu = Orangtua::where('user_id', $id)->first();
        $update_ortu = $data_ortu->update([
            'nama_ibu'=>$request->nama_ibu,
            'nik_ibu'=>$request->nik_ibu,
            'pendidikan_terakhir_ibu'=>$request->pendidikan_terakhir_ibu,
            'nama_ayah'=>$request->nama_ayah,
            'nik_ayah'=>$request->nik_ayah,
            'pendidikan_terakhir_ayah'=>$request->pendidikan_terakhir_ayah,
            'alamat'=>$request->alamat,
            'rt'=>$request->rt,
            'rw'=>$request->rw,
            'status_persetujuan'=>$request->status_persetujuan,
            'status_ekonomi'=>$request->status_ekonomi,
            'posyandu_id'=>$request->posyandu_id,
            'desa_kelurahan_id'=>$request->desa_kelurahan_id,
        ]);

        if ($update_akun || $update_ortu) {
            return redirect()->route('kelola_ortu.index')->with('succes', 'Profil Orangtua berhasil di Perbarui');
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
        return redirect()->route('kelola_ortu.index')->with('berhasil', 'Data Orangtua berhasil di hapus');
    }

    
}
