<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanProfil extends Model
{
    protected $table = 'pengaturan_profil';
    protected $fillable = [
        'nama_perusahaan',
        'logo_perusahaan',
        'gambar_perusahaan',
        'sejarah_singkat',
        'visi',
        'misi',
        'alamat',
        'whatsapp_kontak',
        'instagram_link',
        'facebook_link',
        'youtube_link',
    ];
}