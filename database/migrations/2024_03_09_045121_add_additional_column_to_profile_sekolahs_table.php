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
        Schema::table('profil_sekolahs', function (Blueprint $table) {
            // tambah kolom nama, alamat, hp, email, twitter, facebook, instagram, youtube, visi, misi, tujuan, logo dan buat nullable semua kolom
            $table->string('nama')->nullable()->after('id');
            $table->text('alamat')->nullable()->after('nama');
            $table->string('hp')->nullable()->after('alamat');
            $table->string('email')->nullable()->after('hp');
            $table->string('twitter')->nullable()->after('email');
            $table->string('facebook')->nullable()->after('twitter');
            $table->string('instagram')->nullable()->after('facebook');
            $table->string('youtube')->nullable()->after('instagram');
            $table->text('visi')->nullable()->after('youtube');
            $table->text('misi')->nullable()->after('visi');
            $table->text('tujuan')->nullable()->after('misi');
            $table->string('logo')->nullable()->after('tujuan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profil_sekolahs', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('alamat');
            $table->dropColumn('hp');
            $table->dropColumn('email');
            $table->dropColumn('twitter');
            $table->dropColumn('facebook');
            $table->dropColumn('instagram');
            $table->dropColumn('youtube');
            $table->dropColumn('visi');
            $table->dropColumn('misi');
            $table->dropColumn('tujuan');
            $table->dropColumn('logo');
        });
    }
};
