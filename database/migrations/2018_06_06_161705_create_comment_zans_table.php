<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentZansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_zans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id') ->index() ->connect('关联用户ID');
            $table->integer('comment_id') ->index() ->connect('关联评论ID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_zans');
    }
}
