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
            // ubah kolom id_role_for_pengumuman jadi nullable
            $table->unsignedBigInteger('id_role_for_pengumuman')->nullable()->change();

            // ubah kolom id_kelas_for_pengumuman jadi nullable
            $table->unsignedBigInteger('id_kelas_for_pengumuman')->nullable()->change();
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
            // ubah kolom id_role_for_pengumuman jadi not nullable
            $table->unsignedBigInteger('id_role_for_pengumuman')->nullable(false)->change();

            // ubah kolom id_kelas_for_pengumuman jadi not nullable
            $table->unsignedBigInteger('id_kelas_for_pengumuman')->nullable(false)->change();
        });
    }
};
