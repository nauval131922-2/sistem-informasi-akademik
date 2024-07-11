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
        Schema::table('nilais', function (Blueprint $table) {
            // pada kolom tipe nilai semula enumnya ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'] tambah 'Ujian'
            $table->enum('tipe_nilai', ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor', 'Ujian'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            // pada kolom tipe nilai semula enumnya ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'] hapus 'Ujian'
            $table->enum('tipe_nilai', ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'])->change();
        });
    }
};
