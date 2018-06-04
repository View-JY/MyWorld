<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleZansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_zans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id') ->index() ->connect('关联用户ID');
            $table->integer('article_id') ->index() ->connect('关联文章ID');
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
        Schema::dropIfExists('article_zans');
    }
}
