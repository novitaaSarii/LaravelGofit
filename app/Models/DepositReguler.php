<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositReguler extends Model
{
    use HasFactory;

    protected  $fillable = [
        'id',
        'id_deposit_regulers',
        'id_promo',
        'id_member',
        'nama_member',
        'tanggal_transaksi_deposit',
        'bonus_deposit',
        'sisa_deposit',
        'id_pegawai',
        'nama_pegawai',
        'total_deposit'
        ];
}
