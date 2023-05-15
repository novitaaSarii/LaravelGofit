<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_instruktur',
        'nama_instruktur',
        'alamat_instruktur',
        'telepon_instruktur',
        'email_instruktur',
        'password_instruktur'
        ];
}
