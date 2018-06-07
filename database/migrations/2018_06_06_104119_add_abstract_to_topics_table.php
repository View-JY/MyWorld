<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAbstractToTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('work_topics', function (Blueprint $table) {
          $table ->string('abstract') ->connect('文章简介');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('work_topics', function (Blueprint $table) {
          $table ->ropColumn('abstract');
      });
    }
}
