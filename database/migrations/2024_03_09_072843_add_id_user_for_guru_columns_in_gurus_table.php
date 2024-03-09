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
        Schema::table('gurus', function (Blueprint $table) {
            // tambah kolom id_user_for_guru ke table users dan set cascade on delete dan update jika id_user_for_guru di users dihapus atau diupdate maka id_user_for_guru di gurus juga akan dihapus atau diupdate juga
            $table->foreignId('id_user_for_guru')->constrained('users')->onUpdate('cascade')->onDelete('cascade')->after('id_jabatan_for_guru')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropForeign(['id_user_for_guru']);
            $table->dropColumn('id_user_for_guru');
        });
    }
};
