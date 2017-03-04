<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentrepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentreplies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('commentreply');
            $table->string('email');
            $table->integer('comment_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('commentreplies', function($table) {
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropForeign('comment_id');
        Schema::drop('commentreplies');
    }
}
