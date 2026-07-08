<?php
// database/migrations/xxxx_create_kreator_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kreator', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username'); 
            $table->string('platform')->default('Instagram'); // TikTok / Instagram
            $table->string('judul')->nullable()->after('nama');
            $table->string('sub_judul')->nullable()->after('judul');
            $table->text('deskripsi')->nullable()->after('sub_judul');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kreator');
    }
};