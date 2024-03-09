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
            // tambah kolom tipe jadwal dan hari
            $table->enum('tipe_jadwal', ['Pelajaran', 'Ekstrakurikuler'])->after('id');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'])->after('tipe_jadwal');

            // tambah foreign key id_kelas_for_jadwal ke table kelas dan set cascade on delete dan update jika id_kelas_for_jadwal di kelas dihapus atau diupdate maka id_kelas_for_jadwal di jadwal_pelajarans juga akan dihapus atau diupdate juga
            $table->foreignId('id_kelas_for_jadwal')->constrained('kelas')->onUpdate('cascade')->onDelete('cascade')->after('hari')->nullable();

            // tambah foreign key id_guru_for_jadwal ke table gurus dan set cascade on delete dan update jika id_guru_for_jadwal di gurus dihapus atau diupdate maka id_guru_for_jadwal di jadwal_pelajarans juga akan dihapus atau diupdate juga
            $table->foreignId('id_guru_for_jadwal')->constrained('users')->onUpdate('cascade')->onDelete('cascade')->after('id_kelas_for_jadwal')->nullable();

            // tambah foreign key id_ekstra_for_jadwal ke table ekstrakurikulers dan set cascade on delete dan update jika id_ekstra_for_jadwal di ekstrakurikulers dihapus atau diupdate maka id_ekstra_for_jadwal di jadwal_pelajarans juga akan dihapus atau diupdate juga
            $table->foreignId('id_ekstra_for_jadwal')->constrained('ekstrakurikulers')->onUpdate('cascade')->onDelete('cascade')->after('id_guru_for_jadwal')->nullable();

            // tambah foreign key id_jam_for_jadwal ke table jams dan set cascade on delete dan update jika id_jam_for_jadwal di jams dihapus atau diupdate maka id_jam_for_jadwal di jadwal_pelajarans juga akan dihapus atau diupdate juga
            $table->foreignId('id_jam_for_jadwal')->constrained('jam_pelajarans')->onUpdate('cascade')->onDelete('cascade')->after('id_ekstra_for_jadwal')->nullable();

            // tambah foreign key id_mapel_for_jadwal ke table mapels dan set cascade on delete dan update jika id_mapel_for_jadwal di mapels dihapus atau diupdate maka id_mapel_for_jadwal di jadwal_pelajarans juga akan dihapus atau diupdate juga
            $table->foreignId('id_mapel_for_jadwal')->constrained('mata_pelajarans')->onUpdate('cascade')->onDelete('cascade')->after('id_jam_for_jadwal')->nullable();

            // tambah foreign key id_tahun_ajaran_for_jadwal ke table tahun_ajarans dan set cascade on delete dan update jika id_tahun_ajaran_for_jadwal di tahun_ajarans dihapus atau diupdate maka id_tahun_ajaran_for_jadwal di jadwal_pelajarans juga akan dihapus atau diupdate juga
            $table->foreignId('id_tahun_ajaran_for_jadwal')->constrained('tahun_ajarans')->onUpdate('cascade')->onDelete('cascade')->after('id_mapel_for_jadwal')->nullable();
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
            $table->dropColumn('tipe_jadwal');
            $table->dropColumn('hari');
            $table->dropForeign(['id_kelas_for_jadwal']);
            $table->dropColumn('id_kelas_for_jadwal');
            $table->dropForeign(['id_guru_for_jadwal']);
            $table->dropColumn('id_guru_for_jadwal');
            $table->dropForeign(['id_ekstra_for_jadwal']);
            $table->dropColumn('id_ekstra_for_jadwal');
            $table->dropForeign(['id_jam_for_jadwal']);
            $table->dropColumn('id_jam_for_jadwal');
            $table->dropForeign(['id_mapel_for_jadwal']);
            $table->dropColumn('id_mapel_for_jadwal');
            $table->dropForeign(['id_tahun_ajaran_for_jadwal']);
            $table->dropColumn('id_tahun_ajaran_for_jadwal');
        });
    }
};
