<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{

    protected $table = 'cabangs';

    protected $fillable = [
        'kode_cabang',
        'kota',
        'provinsi',
        'tanggal_peresmian',
        'detail_lokasi',
        'email',
        'deskripsi',
        'status'
    ];

}