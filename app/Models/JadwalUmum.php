<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalUmum extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_kelas',
        'id_instruktur',
        'hari_jadwal_umum',
        'waktu',
        'jenis_kelas',
    ];
}
