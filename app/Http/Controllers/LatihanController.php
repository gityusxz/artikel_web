<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    //

    public function tampil()
    {
        return view('data/kategori');
    }

    public function cekID($id, $nama)
    {
        // return view('data/kategori', compact('id', 'nama'));

        //return view pake array

        return view(
            'data/kategori',
            [
                'id' => $id
            ],
            [
                'nama' => $nama
            ]
        );
    }

    public function index($id){
        $kategori = [
            [
                'id' => 1,
                'nama_kategori' => "Olahraga"
            ],
            [
                'id' => 2,
                'nama_kategori' => "Kuliner"
            ], [
                'id' => 3,
                'nama_kategori' => "Adventure"
            ]
            ];
        
        // dd($kategori);
        return view('data/list', compact('kategori', 'id'));


    }

    //mirip function create di resource controller
    public function formPost(){
        return view('data/form_tambah');
    }

    //mirip function store di resource controller
    public function simpan(Request $r){

    //    dd($r->all());
       
        $inp_nama = $r->get('nama');
       
       //estimasi query simpan sudah berhasil
        return redirect()->route('dashboard');
        // return $inp_nama;
        // return view('data/form_tambah');
    }

    public function about(){
        return view('about');
    }

    public function home(){
        return view('home');
    }

    public function login(){
        return view('login');
    }


}



