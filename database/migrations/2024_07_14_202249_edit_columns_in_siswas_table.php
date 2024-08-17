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
            // ubah kolom alamat_ayah dan alamat_ibu dari varchar ke text
            $table->text('alamat_ayah')->nullable()->change();
            $table->text('alamat_ibu')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // ubah kolom alamat_ayah dan alamat_ibu dari text ke varchar
            $table->string('alamat_ayah')->nullable()->change();
            $table->string('alamat_ibu')->nullable()->change();
        });
    }
};
