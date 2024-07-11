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
            // ubah kolom jenis kelamin menjadi nullable
            $table->string('jenis_kelamin')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // ubah kolomenis kelamin menjadi nullable
            $table->string('jenis_kelamin')->nullable(false)->change();
        });
    }
};
