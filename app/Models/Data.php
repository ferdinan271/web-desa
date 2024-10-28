<?php

namespace App\Models;

use illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
   

    protected $fillable = [
        'nama_lembaga',
        'jenis_lembaga',
        'tahun_berdiri',
        'no_oprasional',
        'no_wa',
        'dikeluarkan_oleh',
        'alamat',
        'status',
    ];
}
