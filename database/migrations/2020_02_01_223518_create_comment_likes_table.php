<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('comment_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });
        Schema::table('comment_likes', function (Blueprint $table) {
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('CASCADE');
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
        Schema::table('comment_likes', function (Blueprint $table) {
            $table->dropForeign('comment_likes_user_id_foreign');
            $table->dropForeign('comment_likes_comment_id_foreign');
        });
        Schema::dropIfExists('comment_likes');
    }
}
