<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Kategori;

class ApiKategoriController extends Controller
{

    public function index()
    {
        $data = Kategori::all();

        return response()->json([
            "status" => true,
            "message" => "Data Kategori",
            "data" => $data
        ], 200);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {


        $validate = Validator::make($request->all(),[
            'kategori' => 'required'

        ]);

        // bikin logika kalau validasi bermasalah
        //return validasinya berupa json
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        //simpan kedalam DB
        $simpan = Kategori::create([
            //susunannya adalah
            //nama field DB => nama form
            'kategori' => $request->kategori
        ]);

        //bikin respon JSON kalau berhasil input data
        if($simpan){
            return response()->json([
                "status" => true,
                "message" => "Data Kategori Berhasil Di Tambahkan",
                "data" => $simpan
            ], 201);
        }
    }


    public function show($id) 
    {
        $show = Kategori::findOrFail($id);

        return response()->json([
            "status" => true,
            "message" => "Data Kategori",
            "data" => $show
        ], 200);
    }


    public function edit($id)
    {
        $edit = Kategori::findOrFail($id);

        return response()->json([
            "status" => true,
            "message" => "Data Kategori",
            "data" => $edit
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $update = Kategori::findOrFail($id);

        $validate = Validator::make($request->all(),[
            'kategori' => 'required'

        ]);

        // bikin logika kalau validasi bermasalah
        //return validasinya berupa json
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

       

         //simpan kedalam DB
         
            $update->update([
                //susunannya adalah
                //nama field DB => nama form
                'kategori' => $request->kategori
            ]);

            return response()->json([
                "status" => true,
                "message" => "Data Kategori Berhasil Di Ubah",
                "data" => $update
            ], 200);
         
       

       

    }


    public function destroy($id)
    {
        $delete = Kategori::findOrFail($id);

        if ($delete) {
            $delete->delete();
            return response()->json([
                "status" => true,
                "message" => "Data Kaegori Berhasil Di Hapus"
            ], 200);
        }
        //
    }
}
