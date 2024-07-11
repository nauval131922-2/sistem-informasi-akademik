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
        Schema::table('siswas', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // hapus kolom nis, nama ayah, nama ibu, dan asal sekolah
            $table->dropColumn(['nis', 'nama_ayah', 'nama_ibu', 'asal_sekolah']);
        });
    }
};
