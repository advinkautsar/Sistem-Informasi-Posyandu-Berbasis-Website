<?php

namespace App\Http\Controllers\WEB\PetugasPuskesmas;

use App\Http\Controllers\Controller;
use App\Models\Tips_kesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Path\To\DOMDocument;
// use Intervention\Image\ImageManagerStatic as Image;
use Image;

class TipsCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tips = Tips_kesehatan::all();

        return view('petugas_puskesmas.tips_kesehatan.index', compact(['data_tips']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas_puskesmas.tips_kesehatan.create');
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
            'judul_tips' => 'required',
            'keterangan' => 'required',
        ]);
       

        $storage = "isi";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->keterangan, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filepath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)
                    ->resize(1200, 1200)
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));
                $new_src = url("public/".$filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        //memasukkan data kedalam database
        $create_tips = Tips_kesehatan::create([
            'judul_tips' => $request->judul_tips,
            'keterangan' => $dom->saveHTML(),
        ]);

        if ($create_tips) {
            return redirect()->route('tips.index')->with('succes', 'Artikel baru telah ditambahkan');
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
        $tips = DB::table('tips_kesehatan')
            ->select('tips_kesehatan.*')
            ->where('id', $id)
            ->get();

        return view('petugas_puskesmas.tips_kesehatan.show', compact(['tips']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tips = Tips_kesehatan::find($id);
        return view('petugas_puskesmas.tips_kesehatan.edit', compact(['tips']));
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
            'judul_tips' => 'required',
            'keterangan' => 'required',
        ]);


        $storage = "isi";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->keterangan, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filepath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)
                    ->resize(1200, 1200)
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));
                $new_src = url("public/".$filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        $pos = Tips_kesehatan::find($id);
        $pos->update([
            //'category_id'=>$request->category,
            'judul_tips'=>$request->judul_tips,
            //'content'=>$request->content,
            'keterangan'=>$dom->saveHTML(),
        ]);

       if ($pos) {
           return redirect()->route('tips.index')->with('succes', 'Data posyandu berhasil terdaftar');
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
        $tips = Tips_kesehatan::whereId($id)->first();
        Tips_kesehatan::whereId($id)->delete();
        return back()->with('berhasil', 'Hapus data sukses!');
    }
}
