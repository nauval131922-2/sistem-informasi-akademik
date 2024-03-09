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
        Schema::table('pengumumen', function (Blueprint $table) {
            // tambah kolom judul, gambar, isi
            $table->string('judul')->after('id');
            $table->string('gambar')->after('judul');
            $table->text('isi')->after('gambar');

            // tambah foreign key id_role_for_pengumuman ke table roles dan set cascade on delete dan update jika id_role_for_pengumuman di roles dihapus atau diupdate maka id_role_for_pengumuman di pengumumen juga akan dihapus atau diupdate juga
            $table->foreignId('id_role_for_pengumuman')->constrained('jabatans')->onUpdate('cascade')->onDelete('cascade')->after('isi')->nullable();

            // tambah foreign key id_kelas_for_pengumuman ke table kelas dan set cascade on delete dan update jika id_kelas_for_pengumuman di kelas dihapus atau diupdate maka id_kelas_for_pengumuman di pengumumen juga akan dihapus atau diupdate juga
            $table->foreignId('id_kelas_for_pengumuman')->constrained('kelas')->onUpdate('cascade')->onDelete('cascade')->after('id_role_for_pengumuman')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengumumen', function (Blueprint $table) {
            $table->dropColumn('judul');
            $table->dropColumn('gambar');
            $table->dropColumn('isi');
            $table->dropForeign(['id_role_for_pengumuman']);
            $table->dropColumn('id_role_for_pengumuman');
            $table->dropForeign(['id_kelas_for_pengumuman']);
            $table->dropColumn('id_kelas_for_pengumuman');
        });
    }
};
