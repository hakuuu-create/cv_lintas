<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kreator', function (Blueprint $table) {
            // menambahkan opsioanal kreator
            $table->string('nama_2')->nullable();
            $table->string('username_2')->nullable();
            $table->string('platform_2')->nullable();

            // menambahkan opsioanal kreator
            $table->string('nama_3')->nullable();
            $table->string('username_3')->nullable();
            $table->string('platform_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('kreator', function (Blueprint $table) {
        $table->dropColumn([
            'nama_2', 'username_2', 'platform_2',
            'nama_3', 'username_3', 'platform_3'
        ]);
    });
    }
};
