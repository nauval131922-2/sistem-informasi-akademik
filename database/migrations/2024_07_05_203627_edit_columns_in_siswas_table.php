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
            // hapus kolom cita_cita dan hobi
            $table->dropColumn('cita_cita');
            $table->dropColumn('hobi');

            // tambah kolom id_cita_cita_for_siswa, id_hobi_for_siswa
            $table->foreignId('id_cita_cita_for_siswa')->nullable()->constrained('cita_citas')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('id_hobi_for_siswa')->nullable()->constrained('hobis')->onUpdate('cascade')->onDelete('set null');

            // hapus kolom pekerjaan ayah, pekerjaan ibu
            $table->dropColumn('pekerjaan_ayah');
            $table->dropColumn('pekerjaan_ibu');

            // tambah kolom id_pekerjaan_ayah_for_siswa, id_pekerjaan_ibu_for_siswa
            $table->foreignId('id_pekerjaan_ayah_for_siswa')->nullable()->constrained('pekerjaans')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('id_pekerjaan_ibu_for_siswa')->nullable()->constrained('pekerjaans')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // tambah kolom hobi dan cita_cita
            $table->string('cita_cita')->nullable();
            $table->string('hobi')->nullable();

            // hapus kolom id_cita_cita_for_siswa, id_hobi_for_siswa
            $table->dropForeign(['id_cita_cita_for_siswa']);
            $table->dropColumn('id_cita_cita_for_siswa');
            $table->dropForeign(['id_hobi_for_siswa']);
            $table->dropColumn('id_hobi_for_siswa');

            // tambah kolom pekerjaan ayah, pekerjaan ibu
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();

            // hapus kolom id_pekerjaan_ayah_for_siswa, id_pekerjaan_ibu_for_siswa
            $table->dropForeign(['id_pekerjaan_ayah_for_siswa']);
            $table->dropColumn('id_pekerjaan_ayah_for_siswa');
            $table->dropForeign(['id_pekerjaan_ibu_for_siswa']);
            $table->dropColumn('id_pekerjaan_ibu_for_siswa');
        });
    }
};
