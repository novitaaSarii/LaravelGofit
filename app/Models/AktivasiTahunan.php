<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivasiTahunan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_aktivasi',
        'id_member',
            'nama_pegawai',
            'id_pegawai',
            'nama_member',
            'tanggal_aktivasi',
            'biaya_aktivasi',
            'masa_aktif',
            
        ];
}
