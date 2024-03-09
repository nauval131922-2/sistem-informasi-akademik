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
        Schema::table('jam_pelajarans', function (Blueprint $table) {
            // tambah kolom jam ke, jam mulai, jam selesai, tip jam
            $table->integer('jam_ke')->after('id');
            $table->time('jam_mulai')->after('jam_ke');
            $table->time('jam_selesai')->after('jam_mulai');
            $table->enum('tipe_jam', ['Pelajaran', 'Istirahat'])->after('jam_selesai')->default('Pelajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jam_pelajarans', function (Blueprint $table) {
            $table->dropColumn('jam_ke');
            $table->dropColumn('jam_mulai');
            $table->dropColumn('jam_selesai');
            $table->dropColumn('tipe_jam');
        });
    }
};
