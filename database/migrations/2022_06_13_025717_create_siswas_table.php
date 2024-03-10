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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('id_kelas')->unsigned();
            // $table->string('nama')->nullable();
            $table->string('nis')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('alamat')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->date('tanggal_masuk')->nullable();
            // $table->string('foto')->nullable();
            $table->timestamps();

            // tambah foreign key id_user_for_siswa di tabel siswas yang merujuk ke id di tabel users dan cascading delete jika id di tabel users dihapus
            $table->foreignId('id_user_for_siswa')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
};
