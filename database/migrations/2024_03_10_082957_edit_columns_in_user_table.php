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
            // ubah id_kelas dan id_mapel jadi nullable
            $table->unsignedBigInteger('id_kelas')->nullable()->change();
            $table->unsignedBigInteger('id_mapel')->nullable()->change();
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
            // ubah id_kelas dan id_mapel jadi not nullable
            $table->unsignedBigInteger('id_kelas')->nullable(false)->change();
            $table->unsignedBigInteger('id_mapel')->nullable(false)->change();
        });
    }
};
