<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositKelas extends Model
{
    use HasFactory;

    protected  $fillable = [
        'id',
        'id_deposit_kelas',
        'id_member',
        'id_promo',
        'nama_member',
        'tanggal_deposit_kelas',
        'waktu_pembayaran',
        'nama_kelas',
        'total_deposit_kelas',
        'masa_berlaku',
        'id_pegawai',
        'nama_pegawai'
        ];
}
