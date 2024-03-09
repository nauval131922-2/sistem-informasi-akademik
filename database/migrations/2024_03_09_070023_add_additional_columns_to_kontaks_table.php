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
        Schema::table('kontaks', function (Blueprint $table) {
            // tambah kolom name, email, subject, message, dan status
            $table->string('name')->after('id');
            $table->string('email')->after('name');
            $table->string('subject')->after('email');
            $table->text('message')->after('subject');
            $table->enum('status', ['Sudah dibalas', 'Belum dibalas'])->after('message')->default('Belum dibalas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kontaks', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('subject');
            $table->dropColumn('message');
            $table->dropColumn('status');
        });
    }
};
