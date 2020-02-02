<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('post_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });
        Schema::table('post_likes', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_likes', function (Blueprint $table) {
            $table->dropForeign('post_likes_user_id_foreign');
            $table->dropForeign('post_likes_post_id_foreign');
        });
        Schema::dropIfExists('post_likes');
    }
}
