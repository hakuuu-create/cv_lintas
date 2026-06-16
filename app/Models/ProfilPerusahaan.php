<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPerusahaan extends Model
{
    protected $table = 'profil_perusahaan';
    protected $fillable = [
        // 'nama_perusahaan',
        'logo_perusahaan',
        'gambar_perusahaan',
        // 'sejarah_singkat',
        // 'alamat',
        'whatsapp_kontak',
        'instagram_link',
        'facebook_link',
        'youtube_link'
    ];
}