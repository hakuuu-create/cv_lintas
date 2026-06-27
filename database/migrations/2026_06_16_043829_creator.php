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
            $table->string('platform')->default('TikTok'); // TikTok / Instagram
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kreator');
    }
};