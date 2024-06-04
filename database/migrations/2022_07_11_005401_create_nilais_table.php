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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // kolom judul
            $table->string('judul');
            // kolom nilai
            $table->integer('nilai');
            // kolom tipe nilai
            $table->enum('tipe_nilai', ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilais');
    }
};
