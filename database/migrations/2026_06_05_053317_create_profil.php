<?php
// database/migrations/2026_06_05_053317_create_profil.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_perusahaan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('logo_perusahaan')->nullable();
            $table->text('sejarah_singkat')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('alamat');
            $table->string('whatsapp_kontak');
            $table->string('instagram_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->timestamps();
        });

        // Tabel kegiatan sekalian dibuat di sini
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('judul_kegiatan');
            $table->string('slug')->unique();
            $table->text('deskripsi_singkat');
            $table->longText('konten_lengkap');
            $table->string('foto_kegiatan')->nullable();
            $table->date('tanggal_kegiatan');
            $table->string('penulis');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
        Schema::dropIfExists('profil_perusahaan');
    }
};