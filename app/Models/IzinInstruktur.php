<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinInstruktur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
       
        'id_instruktur',

        'id_jadwal_harian',
        'nama_instruktur',
        'tanggal_izin',

        'keterangan_izin',
        'sesi_izin',
        'id_pegawai',
        'status',
        ]; 
}
