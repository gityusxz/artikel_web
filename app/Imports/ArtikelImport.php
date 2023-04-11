<?php

namespace App\Imports;


use App\Models\Artikel;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class ArtikelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Artikel([
            'judul_artikel' => $row[1],
            'isi'    => $row[2],
            'gambar' => $row[3],
            'kategori_id' => $row[4],
            'created_at' => $row[5],
            'updated_at' => $row[6]
           

        ]);
    }
}
