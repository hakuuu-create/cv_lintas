<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPerusahaan extends Model
{
    protected $table = 'profil_perusahaan';
    protected $fillable = [
        'judul',
        'sub_judul',
        'konten',
        'foto',
    ];
}