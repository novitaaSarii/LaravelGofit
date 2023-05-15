<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalHarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_jadwal_harian',
        'id_pegawai',

        'id_kelas',
        'tanggal',
        'hari_jadwal_harian',

        'waktu',
        'jenis_kelas',
        'keterangan_kelas',
        ]; 
}
