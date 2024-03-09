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
        Schema::table('users', function (Blueprint $table) {
            // tambah kolom profile_image
            $table->string('profile_image')->nullable()->after('password');

            // tambah foreign key id_role ke table jabatans dan set cascade on delete dan update jika id_role di jabatans dihapus atau diupdate maka id_role di users juga akan dihapus atau diupdate juga
            $table->foreignId('id_role')->constrained('jabatans')->onUpdate('cascade')->onDelete('cascade')->after('profile_image');

            // tambah foreign key id_kelas ke table kelas dan set cascade on delete dan update jika id_kelas di kelas dihapus atau diupdate maka id_kelas di users juga akan dihapus atau diupdate juga
            $table->foreignId('id_kelas')->constrained('kelas')->onUpdate('cascade')->onDelete('cascade')->after('id_role');

            // tambah foreign key id_mapel ke table mata_pelajarans dan set cascade on delete dan update jika id_mapel di mata_pelajarans dihapus atau diupdate maka id_mapel di users juga akan dihapus atau diupdate juga
            $table->foreignId('id_mapel')->constrained('mata_pelajarans')->onUpdate('cascade')->onDelete('cascade')->after('id_kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // hapus kolom profile_image
            $table->dropColumn('profile_image');

            // hapus foreign key id_role
            $table->dropForeign(['id_role']);
            $table->dropColumn('id_role');

            // hapus foreign key id_kelas
            $table->dropForeign(['id_kelas']);
            $table->dropColumn('id_kelas');

            // hapus foreign key id_mapel
            $table->dropForeign(['id_mapel']);
            $table->dropColumn('id_mapel');
        });
    }
};
