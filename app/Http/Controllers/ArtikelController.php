<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//untuk validasi data
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;

use App\Imports\ArtikelImport;
use App\Exports\ArtikelExport;

//langkah 1
//include modelnya
use App\Models\Artikel;
use App\Models\Kategori;

class ArtikelController extends Controller
{
   
    public $artikel;
    // membuat instance dari model artikel
    public function __construct()
    {
       $this->artikel = new Artikel;
    //    $this->middleware('auth');
       
        $this->middleware(function($request, $next){
            if(Gate::allows('admin')) return $next($request);
            abort(403);
        });
       
    }
    
    
    
    
    
    public function index(Request $request)
    {
        
       
        //ini sama persis kaya "select *..........."
       

        //sintaks query builder
        // $data = DB::table('artikels')
        // ->join('kategori','artikels.kategori_id','=','kategori.id_kategori')
        // ->select('artikels.*','kategori.*')->get(); //get ini buat nampilin semua data

        
        //sintaks query eloquent
        // $data = Artikel::all();
        
        
       

        //cek query jalan atau tidak
        //dump dan die
        // dd($data);

        //tampil data + pagination
        $batas = 2;
       
        $data = Artikel::paginate($batas);
        $no = $batas * ($data->currentPage() - 1);
        $cari = $request->search;

        //eksekusi query
        // $data = Artikel::where('judul_artikel', 'LIKE', "%$cari%")->simplePaginate($batas);

        //JIKA INGIN SEARCH BISA DLM 2 KONDISI DARI 2 TABLE BERBEDA (ARTIKELS & KATEGORI)
        $data = DB::table('artikels')
            ->join('kategori', 'artikels.kategori_id', '=', 'kategori.id_kategori')
            ->select('artikels.*', 'kategori.*')
            ->where('artikels.judul_artikel', 'LIKE', "%$cari%")
            ->orWhere('kategori.kategori', 'LIKE', "%$cari%")->paginate($batas)->withQueryString();
        
        return view('artikel/index', compact('data','no')) ;

    }

    
    public function impor()
    {
        
      
        
        return view('artikel/impor');

        
    }
    
    
    public function import(Request $request)
    {
        $this->validate($request, [
            'excel' => 'required|mimes:csv,xls,xlsx'
        ]);
        Excel::import(new ArtikelImport, $request->excel);
        return redirect()->route('artikel.index')->with('status', 'Data artikel berhasil dihapus');
       
      

    //     $file = $request->file('excel');

    //     // // membuat nama file unik
    //     $nama_file = $file->hashName();

    //     // //temporary file
    //     $path = $file->storeAs('public/excel/',$nama_file);

    //     // // import data
    //     $import = Excel::import(new ArtikelImport(), storage_path('app/public/excel/'.$nama_file));

    //     // //remove from server
    //     Storage::delete($path);

    //      if($import) {
    //          //redirect
    //          return redirect()->route('artikel.index')->with('status', 'Data artikel berhasil dihapus');
    //      } else {
    //          //redirect
    //         return redirect()->route('artikel.index');
    //     }
     }

    
    public function export() 
{
        return Excel::download(new ArtikelExport, 'artikel.xlsx');
}
    
    
    public function create()
    {
        
      
        $data = Kategori::all();
        return view('artikel/create', compact('data'));

        
    }


    public function store(Request $request)
    {
        // nangkep kiriman user dari form
        // dd($request->all());


        //ini opsi validate 1
        // $validate = Validator::make($request->all(),[
        //     'judul' => 'required',
        //     'gambar' => 'required',
        //     'isi' => 'required'
        // ])->validate();

        //ini opsi validate 2
            $rules = [
                'judul' => 'required|min:3|max:20',
                'gambar' => 'required|max:500|mimes:jpg,png,jpeg',
                'isi' => 'required'

            ];

            $messages = [
                'required' => ":attribute ga boleh kosong",
                'min' => ":attribute minimal 3",
                'max' => ":attribute maksimal 20",
                'mimes' => "extensi file tidak di izinkan"

            ];
            $this->validate($request, $rules, $messages);

            // nambah data ke database query builder
            // Artikel::create(
            //         [
            //             'judul_artikel' => $request->judul,
            //             'isi' => $request->isi,
            //             'gambar' => $request->gambar
    
            //         ]
            //         );

        //tangkap request user
        $nm = $request->gambar;
 
        //ubah nama file yang akan disimpan kedalam DB
        $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
 
        $this->artikel->judul_artikel = $request->judul;
        $this->artikel->isi = $request->isi;
        $this->artikel->gambar = $namaFile;
        $this->artikel->kategori_id = $request->kategori;
 
        //simpan file gambar ke direktori upload yang ada didalam public
        $nm->move(public_path() . '/upload', $namaFile);
 
        // simpan data menggunakan method save()
        $this->artikel->save();
 
        // redirect halaman serta kirimkan pesan berhasil
        Alert::success('Create Succes', 'Data berhasil di tambahkan'); 
        return redirect()->route('artikel.index');
            
            

        
        }


       
    

    public function show($id)
    {
        //ini variabel buat nampung id
        
        //kalau ga ketemu id nya maka ke redirect ke halaman 404
        $show = Artikel::findOrFail($id);
        // dd($show);
        
        
        return view('artikel/show', compact('show'));
    }

    
    public function edit($id)
    {
         //kalau ga ketemu id nya maka ke redirect ke halaman 404
         $edit = Artikel::findOrFail($id);
         //select all kategori
         $kate = Kategori::all();
         // dd($show);
         
         
         return view('artikel/edit', compact('edit','kate'));
    }

    
    public function update(Request $request, $id)
    {
       

        
        
        $update = Artikel::findOrFail($id);

        //deklarasi data lama
        $oldJdl = $request->judul;
        $oldIsi = $request->isi;
        $oldKt = $request->kategori;

        // //deklarasi data update
        $upJd = $update->judul_artikel;
        $upIsi = $update->isi;
        $upKt =  $update->kategori_id;

       
        
        if ($upJd == $oldJdl &&  $upIsi == $oldIsi && $upKt == $oldKt && !$request->gambar){
            return redirect()->route('artikel.index');
        } else { 
       
            
        
         //ini opsi validate 2
        //  $rules = [
        //     'judul' => 'required|min:3|max:20',
        //     'gambar' => 'required|max:500|mimes:jpg,png,jpeg',
        //     'isi' => 'required'

        // ];

        // $messages = [
        //     'required' => ":attribute ga boleh kosong",
        //     'min' => ":attribute minimal 3",
        //     'max' => ":attribute maksimal 20",
        //     'mimes' => "extensi file tidak di izinkan"

        // ];
        // $this->validate($request, $rules, $messages);

        $update->judul_artikel = $request->judul;
        $update->isi = $request->isi;
        $update->kategori_id = $request->kategori; //nambahin update kate disini
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
       
        // redirect halaman serta kirimkan pesan berhasil
        return redirect()->route('artikel.index')->with('status', 'Data artikel berhasil diupdate');

     }//
       


    
     

     
      

      

 
       
    }

   
    public function destroy($id)
    {
        
        $destroy = Artikel::findOrFail($id);
        // dd($show);
        
        
        $path = 'upload/' . $destroy->gambar;
       

        Alert::question('Delete Record?', 'Cannot Undo! Are You Sure?');
        Alert::success('Delete Succes', 'Success Message');   
                if(File::exists($path))
                {
                    File::delete($path);
                    
                }
            
            
            $destroy->delete();
            
            return redirect()->route('artikel.index')->with('status', 'Data artikel berhasil dihapus');
           
        }
    }     
        
        
        
        
        
        
        
       
     


// Alert::question('Delete Record?', 'Cannot Undo! Are You Sure?');

    if (session('status')) {
        $company->delete();
    }
//     return back()->with('status', 'Company Deleted!');