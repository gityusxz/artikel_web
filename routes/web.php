<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KategoriController;

 

 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ROUTE WEB INI FUNGSINYAA BUAT JALUR WEB KITAA

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('template/main');
});

// Route::get('/helo', function () {
//     return "Helo, Selamat datang di tutorial laravel iyusxz";
// });

// Route::get('/artikel/{id}/ipk/{nama}', function ($id, $name) {
//     return "DATA ARTIKEL YANG ID NYA $id dan namanya adalah $name";
// });

// Route::get('/kategori', function () {
//     return "DATA KATEGORI";
// });


//root redirect
Route::get('/data-kategori', function () {
    //PEMISAH ANTARA FOLDER DENGAN FILE
    //BISA PAKE . (TITIK) ATAU PAKE / (SLASH)
    return view('data/kategori');
});
//======================================

//======================================
//route dengan controller
Route::get('/controller', [LatihanController::class, 'tampil'])->name('dashboard');
Route::get('/cek/{id}/{nama}', [LatihanController::class, 'cekID']);
Route::get('/list/{id}', [LatihanController::class, 'index']);


Route::get('/form', [LatihanController::class, 'formPost'])->name('tambah');
Route::post('/simpan', [LatihanController::class, 'simpan']) ->name('simpanPost');

Route::get('/about', [LatihanController::class, 'about'])->name('about');
Route::get('/home', [LatihanController::class, 'home'])->name('home');
Route::get('/login', [LatihanController::class, 'login'])->name('login');


//route dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dash');

//route artikel
// Route::resource('artikel', ArtikelController::class);

Route::middleware(['auth'])->group(function(){
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
Route::post('/artikel/store', [ArtikelController::class, 'store'])->name('artikel.store');
Route::get('/artikel/show/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get('/artikel/{id}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
Route::put('/artikel/update/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
Route::get('/artikel/{id}/destroy', [ArtikelController::class, 'destroy'])->name('artikel.destroy');

//route import export
Route::get('/artikel/impor', [ArtikelController::class, 'impor'])->name('artikel.impor');
Route::post('/artikel/import', [ArtikelController::class, 'import'])->name('artikel.import');
Route::get('/artikel/export', [ArtikelController::class, 'export'])->name('artikel.export');

//route kategori

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori/create');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori/store');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori/edit');
Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori/update');
Route::get('/kategori/{id}/destroy', [KategoriController::class, 'destroy'])->name('kategori/destroy');
});


Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
