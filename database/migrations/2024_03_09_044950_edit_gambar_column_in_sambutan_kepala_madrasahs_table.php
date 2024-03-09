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
        Schema::table('sambutan_kepala_madrasahs', function (Blueprint $table) {
            // ubah kolom gambar menjadi nullable
            $table->string('gambar')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sambutan_kepala_madrasahs', function (Blueprint $table) {
            $table->string('gambar')->change();
        });
    }
};
