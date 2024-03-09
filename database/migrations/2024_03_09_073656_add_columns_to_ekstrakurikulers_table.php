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
        Schema::table('ekstrakurikulers', function (Blueprint $table) {
            // tambah kolom nama dan gambar
            $table->string('nama')->after('id');
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
        Schema::table('ekstrakurikulers', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('gambar');
        });
    }
};
