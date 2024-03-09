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
            // tambah kolo isi
            $table->text('isi')->after('id');
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
            $table->dropColumn('isi');
        });
    }
};
