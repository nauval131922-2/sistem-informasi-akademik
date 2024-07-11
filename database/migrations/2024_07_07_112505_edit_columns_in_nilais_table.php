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
        Schema::table('nilais', function (Blueprint $table) {
            // ubah kolom kompetensi_dasar menjadi nullable
            $table->string('kompetensi_dasar')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            // mengembalikan kolom kompetensi_dasar menjadi not nullable
            $table->string('kompetensi_dasar')->nullable(false)->change();
        });
    }
};
