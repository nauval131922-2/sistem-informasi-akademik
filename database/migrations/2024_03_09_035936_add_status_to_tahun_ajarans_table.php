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
        Schema::table('tahun_ajarans', function (Blueprint $table) {
            $table->enum('status', ['Aktif', 'Nonaktif'])->after('tahun');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tahun_ajarans', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
