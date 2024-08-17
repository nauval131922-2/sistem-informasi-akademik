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
            $table->dropColumn('pekerjaan_wali');

            $table->foreignId('id_pekerjaan_wali_for_siswa')->nullable()->constrained('pekerjaans')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->string('pekerjaan_wali')->nullable();

            $table->dropForeign(['id_pekerjaan_wali_for_siswa']);
        });
    }
};
