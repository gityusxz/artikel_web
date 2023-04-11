<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    //pake ini kalo mau milih yang mana aja yang mau di isi
    // protected $fillable = [
    //     'judul_artikel',
    //     'isi',
    //     'gambar',
    //     'kategori_id'
       
    // ];

    //artinya guarded adalah semua field tidak ada yang dijaga, atau boleh di isi semuanya
    protected $guarded = [];
    

    //ini buat ngasih tau kalo nama table kita gapake konsep singular plural
    // protected $table = "artikel";

    //ini buat ngasih tau kalo PK table kita bukan id
    // protected $primaryKey = 'flight_id';
    
    //relasi pake sintaks eloquent
    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'kategori_id','id_kategori');
    }
    
}


