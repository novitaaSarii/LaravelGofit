<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_member',
        'nama_member',
        'alamat_member',
        'telepon_member',
        'email_member',
        'lahir_member',
        'password_member',
        'jumlah_deposit_kelas',
        'jumlah_deposit_reguler',
        'masa_kadaluarsa_member',
        'masa_kadaluarsa_deposit',
        ]; 
}
