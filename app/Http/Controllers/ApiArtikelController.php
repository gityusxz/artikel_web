<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ApiArtikelController extends Controller
{
    
    public $artikel;
    // membuat instance dari model artikel
    public function __construct()
    {
       $this->artikel = new Artikel;
    }


    public function index()
    {
        $data = Artikel::all();

        return response()->json([
            "status" => true,
            "message" => "Data Artikel",
            "data" => $data
        ], 200);
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
        $validate = Validator::make($request->all(),[
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required|max:1000|mimes:jpg,png,jpeg',
            'kategori_id' => 'required'

        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }


        $nm = $request->gambar;
 
        //ubah nama file yang akan disimpan kedalam DB
        $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();

         //simpan kedalam DB
         $simpan = Artikel::create([
            //susunannya adalah
            //nama field DB => nama form
            'judul_artikel' => $request->judul,
            'isi' => $request->isi,
            'kategori_id' => $request->kategori_id,
            'gambar' => $namaFile
        ]);

         //simpan file gambar ke direktori upload yang ada didalam public
         $nm->move(public_path() . '/upload', $namaFile);


        //bikin respon JSON kalau berhasil input data
        if($simpan){
            return response()->json([
                "status" => true,
                "message" => "Data Artikel Berhasil Di Tambahkan",
                "data" => $simpan
            ], 201);
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
        $show = Artikel::findOrFail($id);

        return response()->json([
            "status" => true,
            "message" => "Data Artikel",
            "data" => $show
        ], 200);
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
        
        
        $validate = Validator::make($request->all(),[
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required|max:1000|mimes:jpg,png,jpeg',
            'kategori_id' => 'required'

        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        
        $update = Artikel::findOrFail($id);

        $update->judul_artikel = $request->judul;
        $update->isi = $request->isi;
        $update->kategori_id = $request->kategori_id; //nambahin update kate disini
        $gambarLama = $update->gambar;

        if(!$request->gambar){
            $update->gambar = $gambarLama;
        }else{
            $path = 'upload/' . $update->gambar;
            if ($update->gambar) {
                 if(File::exists($path))
                 {
                     File::delete($path);
                     $nm = $request->gambar;
                     //ubah nama file
                     $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
                     $update->gambar = $namaFile;
                     $nm->move(public_path() . '/upload', $namaFile);
                 }
            }elseif($request->gambar != $gambarLama){
                // echo "gambar isinya beda";
                $nm = $request->gambar;
                //ubah nama file yang akan disimpan kedalam DB
                $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
                $update->gambar = $namaFile;
                $nm->move(public_path() . '/upload', $namaFile);
                }

        }

       $update->save();
        return response()->json([
            "status" => true,
            "message" => "Data Artikel Berhasil Di Ubah",
            "data" => $update
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Artikel::findOrFail($id);
        $path = 'upload/' . $destroy->gambar;
        if(File::exists($path))
                {
                    File::delete($path);
                }
        $destroy->delete();

        return response()->json([
            "status" => true,
            "message" => "Data Artikel Berhasil Di Hapus"
        ], 200);
    }
}
