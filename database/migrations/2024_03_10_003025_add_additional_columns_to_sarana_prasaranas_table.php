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
        Schema::table('sarana_prasaranas', function (Blueprint $table) {
            // tambah kolom nama
            $table->string('nama')->after('id')->nullable();
            // tambah kolom gambar nullable
            $table->string('gambar')->after('nama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sarana_prasaranas', function (Blueprint $table) {
            // hapus kolom nama
            $table->dropColumn('nama');
            // hapus kolom gambar
            $table->dropColumn('gambar');
        });
    }
};
