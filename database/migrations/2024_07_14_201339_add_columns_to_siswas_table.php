<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // tambah kolom agama
            $table->string('agama')->nullable();
            $table->string('status_dalam_keluarga')->nullable();
            $table->string('anak_ke')->nullable();
            $table->string('nomor_telepon_rumah')->nullable();

            $table->string('nomor_telepon_ayah')->nullable();
            $table->string('nomor_telepon_ibu')->nullable();

            $table->string('alamat_ayah')->nullable();
            $table->string('alamat_ibu')->nullable();

            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('nomor_telepon_wali')->nullable();
            $table->string('alamat_wali')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('agama');
            $table->dropColumn('status_dalam_keluarga');
            $table->dropColumn('anak_ke');
            $table->dropColumn('nomor_telepon_rumah');

            $table->dropColumn('nomor_telepon_ayah');
            $table->dropColumn('nomor_telepon_ibu');

            $table->dropColumn('alamat_ayah');
            $table->dropColumn('alamat_ibu');

            $table->dropColumn('nama_wali');
            $table->dropColumn('pekerjaan_wali');
            $table->dropColumn('nomor_telepon_wali');
            $table->dropColumn('alamat_wali');
        });
    }
};
