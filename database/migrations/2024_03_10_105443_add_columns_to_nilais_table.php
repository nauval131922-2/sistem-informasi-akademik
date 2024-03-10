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
        Schema::table('nilais', function (Blueprint $table) {
            // tambah foreign key id_guru_for_nilai ke kolom id di tabel users dan nullable on delete cascade on update cascade
            $table->foreignId('id_guru_for_nilai')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // tambah foreign key id_kelas_for_nilai ke kolom id di tabel kelas dan nullable on delete cascade on update cascade
            $table->foreignId('id_kelas_for_nilai')->nullable()->constrained('kelas')->onUpdate('cascade')->onDelete('cascade');
            // tambah foreign key id_mapel_for_nilai ke kolom id di tabel mapels dan nullable on delete cascade on update cascade
            $table->foreignId('id_mapel_for_nilai')->nullable()->constrained('mata_pelajarans')->onUpdate('cascade')->onDelete('cascade');
            // tambah foreign key id_siswa_for_nilai ke kolom id di tabel users dan nullable on delete cascade on update cascade
            $table->foreignId('id_siswa_for_nilai')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // tambah foreign key id_tahun_ajaran_for_nilai ke kolom id di tabel tahun_ajarans dan nullable on delete cascade on update cascade
            $table->foreignId('id_tahun_ajaran_for_nilai')->nullable()->constrained('tahun_ajarans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilais', function (Blueprint $table) {
            // hapus foreign key id_guru_for_nilai
            $table->dropForeign(['id_guru_for_nilai']);
            // hapus foreign key id_kelas_for_nilai
            $table->dropForeign(['id_kelas_for_nilai']);
            // hapus foreign key id_mapel_for_nilai
            $table->dropForeign(['id_mapel_for_nilai']);
            // hapus foreign key id_siswa_for_nilai
            $table->dropForeign(['id_siswa_for_nilai']);
            // hapus foreign key id_tahun_ajaran_for_nilai
            $table->dropForeign(['id_tahun_ajaran_for_nilai']);
        });
    }
};
