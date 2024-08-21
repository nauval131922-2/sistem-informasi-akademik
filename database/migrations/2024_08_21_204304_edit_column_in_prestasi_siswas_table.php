<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('prestasi_siswas', function (Blueprint $table) {
            // ubah kolom prestasi_siswa dari varchar(255) menjadi text
            $table->text('prestasi_siswa')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi_siswas', function (Blueprint $table) {
            // ubah kolom prestasi_siswa dari text menjadi varchar(255)
            $table->string('prestasi_siswa')->change();
        });
    }
};
