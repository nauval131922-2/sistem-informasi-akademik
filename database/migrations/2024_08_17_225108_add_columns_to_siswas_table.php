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
            // tambah kolom cita-cita
            $table->string('cita_cita')->nullable();

            // tambah kolom hobi
            $table->string('hobi')->nullable();

            // tambah kolom pekerjaan ayah
            $table->string('pekerjaan_ayah')->nullable();

            // tambah kolom pekerjaan ibu
            $table->string('pekerjaan_ibu')->nullable();

            // tambah kolom pekerjaan wali
            $table->string('pekerjaan_wali')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // hapus kolom pekerjaan wali
            $table->dropColumn('pekerjaan_wali');

            // hapus kolom pekerjaan ibu
            $table->dropColumn('pekerjaan_ibu');

            // hapus kolom pekerjaan ayah
            $table->dropColumn('pekerjaan_ayah');

            // hapus kolom hobi
            $table->dropColumn('hobi');

            // hapus kolom cita-cita
            $table->dropColumn('cita_cita');
        });
    }
};
