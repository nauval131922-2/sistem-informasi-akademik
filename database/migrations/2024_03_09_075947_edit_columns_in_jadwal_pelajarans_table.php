<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            // ubah kolom id_kelas_for_jadwal menjadi nullable
            $table->foreignId('id_kelas_for_jadwal')->nullable()->change();

            // ubah kolom id_guru_for_jadwal menjadi nullable
            $table->foreignId('id_guru_for_jadwal')->nullable()->change();

            // ubah kolom id_mapel_for_jadwal menjadi nullable
            $table->foreignId('id_mapel_for_jadwal')->nullable()->change();

            // ubah kolom id_tahun_ajaran_for_jadwal menjadi nullable
            $table->foreignId('id_tahun_ajaran_for_jadwal')->nullable()->change();

            // ubah kolom id_ekstra_for_jadwal menjadi nullable
            $table->foreignId('id_ekstra_for_jadwal')->nullable()->change();

            // ubah kolom id_jam_for_jadwal menjadi nullable
            $table->foreignId('id_jam_for_jadwal')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            // ubah kolom id_kelas_for_jadwal menjadi not nullable
            $table->foreignId('id_kelas_for_jadwal')->nullable(false)->change();

            // ubah kolom id_guru_for_jadwal menjadi not nullable
            $table->foreignId('id_guru_for_jadwal')->nullable(false)->change();

            // ubah kolom id_mapel_for_jadwal menjadi not nullable
            $table->foreignId('id_mapel_for_jadwal')->nullable(false)->change();

            // ubah kolom id_tahun_ajaran_for_jadwal menjadi not nullable
            $table->foreignId('id_tahun_ajaran_for_jadwal')->nullable(false)->change();

            // ubah kolom id_ekstra_for_jadwal menjadi not nullable
            $table->foreignId('id_ekstra_for_jadwal')->nullable(false)->change();

            // ubah kolom id_jam_for_jadwal menjadi not nullable
            $table->foreignId('id_jam_for_jadwal')->nullable(false)->change();
        });
    }
};
