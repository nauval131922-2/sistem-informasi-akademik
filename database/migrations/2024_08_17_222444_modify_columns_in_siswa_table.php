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
            // hapus kolom id_cita_cita_for_siswa
            $table->dropForeign(['id_cita_cita_for_siswa']);
            $table->dropColumn('id_cita_cita_for_siswa');

            // hapus kolom id_hobi_for_siswa
            $table->dropForeign(['id_hobi_for_siswa']);
            $table->dropColumn('id_hobi_for_siswa');

            // hapus kolom id_pekerjaan_ayah_for_siswa
            $table->dropForeign(['id_pekerjaan_ayah_for_siswa']);
            $table->dropColumn('id_pekerjaan_ayah_for_siswa');

            // hapus kolom id_pekerjaan_ibu_for_siswa
            $table->dropForeign(['id_pekerjaan_ibu_for_siswa']);
            $table->dropColumn('id_pekerjaan_ibu_for_siswa');

            // hapus kolom id_pekerjaan_wali_for_siswa
            $table->dropForeign(['id_pekerjaan_wali_for_siswa']);
            $table->dropColumn('id_pekerjaan_wali_for_siswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // bikin kolom id_cita_cita_for_siswa
            $table->foreignId('id_cita_cita_for_siswa')->nullable()->constrained('cita_citas')->onUpdate('cascade')->onDelete('set null');

            // bikin kolom id_hobi_for_siswa
            $table->foreignId('id_hobi_for_siswa')->nullable()->constrained('hobis')->onUpdate('cascade')->onDelete('set null');

            // bikin kolom id_pekerjaan_ayah_for_siswa
            $table->foreignId('id_pekerjaan_ayah_for_siswa')->nullable()->constrained('pekerjaans')->onUpdate('cascade')->onDelete('set null');

            // bikin kolom id_pekerjaan_ibu_for_siswa
            $table->foreignId('id_pekerjaan_ibu_for_siswa')->nullable()->constrained('pekerjaans')->onUpdate('cascade')->onDelete('set null');

            // bikin kolom id_pekerjaan_wali_for_siswa
            $table->foreignId('id_pekerjaan_wali_for_siswa')->nullable()->constrained('pekerjaans')->onUpdate('cascade')->onDelete('set null');
        });
    }
};
