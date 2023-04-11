<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;


     //ini buat ngasih tau kalo nama table kita gapake konsep singular plural
     protected $table = "kategori";

    //ini buat ngasih tau kalo PK table kita bukan id
    protected $primaryKey = 'id_kategori';

    // opsi 1 ini buat ngasih tau kalo kita izinin field kategori buat di isi
    protected $fillable = [
        'kategori'
    ];

    // opsi 2 artinya guarded adalah semua field tidak ada yang dijaga, atau boleh di isi semuanya
    // protected $guarded = [];

    //relasi pake sintaks eloquent
    public function artikel()
    {
        return $this->hasMany(Artikel::class,'kategori_id','id_kategori');
    }
}
