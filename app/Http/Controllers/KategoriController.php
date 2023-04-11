<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


//include app modelnya
use App\Models\Kategori;

class KategoriController extends Controller
{
    
    public $kategori;
    // membuat instance dari model artikel
    public function __construct()
    {
       $this->kategori = new Kategori;
       $this->middleware('auth');
    }


    public function index()
    {
        //ini sama persis kaya "select *..........."
        $data = Kategori::all();
        return view('kategori/index', compact('data')) ;

        //cek query jalan atau tidak
        //dump dan die
        // dd($data);
    }

    public function create()
    {
        
      
        // $data = Kategori::all();
        return view('kategori/create') ;

        
    }


    public function store(Request $request)
    {
        // nangkep kiriman user dari form
        // dd($request->all());



        //ini opsi validate 2
            $rules = [
                'kategori' => 'required|min:3|max:40|unique:kategori,kategori'
            ];

            $messages = [
                'required' => ":attribute ga boleh kosong",
                'min' => ":attribute minimal 3",
                'max' => ":attribute maksimal 20",
                'unique' => ":attribute sudah tersedia, silahkan input lain"
               

            ];
            $this->validate($request, $rules, $messages);
            $this->kategori->kategori = $request->kategori;
             
            // simpan data menggunakan method save()
            $this->kategori->save();
           
            Alert::success('Create Succes', 'Data kategori berhasil di tambahkan'); 
            // redirect halaman serta kirimkan pesan berhasil
            return redirect()->route('kategori')->with('status', 'Data kategori berhasil ditambahkan'); 
            
            // 

        }
        
       
        public function edit($id)
        {
             //kalau ga ketemu id nya maka ke redirect ke halaman 404
             $edit = Kategori::findOrFail($id);
             // dd($show);
             
             
             return view('kategori/edit', compact('edit'));
        }
        
 
        public function update(Request $request, $id)
        {
            $update = Kategori::findOrFail($id);
            
            if($update->kategori == $request->kategori){

                return redirect()->route('kategori');
            }else{
                $rules = [
                    'kategori' => 'required|min:3|max:40|unique:kategori,kategori'
                  
    
                ];
    
                $messages = [
                    'required' => ":attribute ga boleh kosong",
                    'min' => ":attribute minimal 3",
                    'max' => ":attribute maksimal 20",
                    'unique' => ":attribute sudah tersedia, silahkan input lain"
                   
    
                ];
                $this->validate($request, $rules, $messages);
                $update->kategori = $request->kategori;
                $update->save();
           
                // redirect halaman serta kirimkan pesan berhasil
                return redirect()->route('kategori')->with('status', 'Data kategori berhasil diupdate');
            }
            
            
        }  
              
                
    
            


        public function destroy($id)
        {
            
            $destroy = Kategori::findOrFail($id);
            // dd($show);
            
            $destroy->delete();
            return redirect()->route('kategori')->with('status', 'Data kategori berhasil dihapus');
        }
     
    }
 
       
            
            

        
        

      


           
                
                
               


