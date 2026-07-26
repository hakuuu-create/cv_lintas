<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kreator extends Model
{
    protected $table = 'kreator';
    protected $fillable = [
        'nama',
        'judul',
        'sub_judul',
        'deskripsi',
        'username',
        'platform',
        'foto',

        // Model kreator (opsional) hanya digunakan saat ingin menambahkan lebih dari kreator lebih dari 1
        'nama_2',
        'username_2',
        'platform_2',
        'nama_3',
        'username_3',
        'platform_3'
    ];
}