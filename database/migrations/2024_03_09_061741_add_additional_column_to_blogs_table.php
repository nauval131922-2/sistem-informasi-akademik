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
        Schema::table('blogs', function (Blueprint $table) {
            // tambah kolom foreign key blog_category_id ke table blog_categories dan set cascade on delete dan update jika blog_category_id di blog_categories dihapus atau diupdate maka blog_category_id di blogs juga akan dihapus atau diupdate juga
            $table->foreignId('blog_category_id')->nullable()->constrained('blog_categories')->onUpdate('cascade')->onDelete('set null')->after('blog_image');

            // tambah kolom foreign key id_user_for_blog ke table users dan set cascade on delete dan update jika id_user_for_blog di users dihapus atau diupdate maka id_user_for_blog di blogs juga akan dihapus atau diupdate juga
            $table->foreignId('id_user_for_blog')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null')->after('blog_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            //
        });
    }
};
