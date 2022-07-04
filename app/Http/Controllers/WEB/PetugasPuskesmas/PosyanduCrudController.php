<?php

namespace App\Http\Controllers\WEB\PetugasPuskesmas;

use App\Http\Controllers\Controller;
use App\Models\Desa_kelurahan;
use App\Models\Posyandu;
use App\Models\Puskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosyanduCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user_petpus = auth()->user()->petugas_puskesmas->puskesmas->id;
        $data_posyandu = DB::table('posyandu')
        ->join('desa_kelurahan', 'posyandu.desa_kelurahan_id', '=', 'desa_kelurahan.id')
        ->select('posyandu.*', 'desa_kelurahan.nama')
        ->where('puskesmas_id','=', $user_petpus)
        ->get();

        
        // return $data_posyandu;
        return view('petugas_puskesmas.posyandu.index', ['data_posyandu' => $data_posyandu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_pus = Puskesmas::all();
        $data_desa = Desa_kelurahan::all();   
        return view('petugas_puskesmas.posyandu.create',compact('data_desa','data_pus'));
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
            'nama_posyandu' => 'required',
            'alamat'=>'required',
            'desa_kelurahan_id' => 'required',
            'puskesmas_id' => 'required',
            'hari_kegiatan' => 'required',
            'minggu_kegiatan' => 'required',
        ]);

       //memasukkan data kedalam database
       $pos = new Posyandu();
       $pos->nama_posyandu = $request->nama_posyandu;
       $pos->alamat = $request->alamat;
       $pos->desa_kelurahan_id = $request->desa_kelurahan_id;
       $pos->puskesmas_id = $request->puskesmas_id;
       $pos->hari_kegiatan = $request->hari_kegiatan;
       $pos->minggu_kegiatan = $request->minggu_kegiatan;

       $save = $pos->save();

       if ($save) {
           return redirect()->route('kelola_posyandu.index')->with('succes', 'Data posyandu berhasil terdaftar');
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
        $data_pos = Posyandu::find($id);
        $data_desa = Desa_kelurahan::all();
        $data_pus = Puskesmas::all();

        return view('petugas_puskesmas.posyandu.edit', compact('data_pos','data_desa','data_pus'));
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
            'nama_posyandu' => 'required',
            'alamat'=>'required',
            'desa_kelurahan_id' => 'required',
            'puskesmas_id' => 'required',
            'hari_kegiatan' => 'required',
            'minggu_kegiatan' => 'required',
        ]);

        $pos = Posyandu::find($id);

            $pos->nama_posyandu = $request->get('nama_posyandu');
            $pos->alamat = $request->get('alamat');
            $pos->desa_kelurahan_id = $request->get('desa_kelurahan_id');
            $pos->puskesmas_id = $request->get('puskesmas_id');
            $pos->hari_kegiatan= $request->get('hari_kegiatan');
            $pos->minggu_kegiatan= $request->get('minggu_kegiatan');

            $pos->save();

        if ($pos) {
            return redirect()->route('kelola_posyandu.index')->with('succes', 'Akun pengguna berhasil di ubah');
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
        $pos = Posyandu::find($id);
        $pos->delete();
        return redirect()->route('kelola_posyandu.index')->with('berhasil', 'Data posyandu berhasil di hapus');
    }
}
