<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Pegawai extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'pegawai';

    protected $casts = [
        'email_pegawai' => 'string'
    ];

    protected $fillable = [
        'id',
        'id_pegawai',
        'nama_pegawai',
        'alamat_pegawai',
        'email_pegawai',
        'password_pegawai',
        'telepon_pegawai'
    ];
}
