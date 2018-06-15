<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeightToAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('adverts', function (Blueprint $table) {
          $table ->integer('weight') ->default(0); // 文章状态 0未知 1通过 -1删除
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
          $table ->dropColumn('weight'); // 文章状态 0未知 1通过 -1删除
      });
    }
}
