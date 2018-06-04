<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title') ->index() ->connect('文章标题');
            $table->text('body') ->connect('文章内容');
            $table->text('cover') ->nullable() ->connect('文章头图');
            $table->string('abstract') ->index() ->connect('文章摘要');
            $table->integer('user_id') ->index() ->connect('关联用户外键');
            $table->integer('category_id') ->index() ->connect('关联文章分类外键');
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
        Schema::dropIfExists('articles');
    }
}
