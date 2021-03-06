<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('comments', function (Blueprint $table) {
          $table ->tinyInteger('status') ->default(0); // 文章状态 0未知 1通过 -1删除
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('comments', function (Blueprint $table) {
          $table ->tinyInteger('status'); // 文章状态 0未知 1通过 -1删除
      });
    }
}
