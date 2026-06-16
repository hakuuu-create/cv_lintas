<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Profil perusahaan (Dinamis isi visi, misi, kontak)
        Schema::create('profil_perusahaan', function (Blueprint $table) {
            $table->id();
            // $table->string('nama_perusahaan');
            $table->string('logo_perusahaan')->nullable();
            $table->string('gambar_perusahaan')->nullable();
            // $table->text('sejarah_singkat');
            // $table->string('alamat');
            $table->string('whatsapp_kontak');
            $table->string('instagram_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_perusahaan');
    }
};