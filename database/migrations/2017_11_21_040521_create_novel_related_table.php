<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novel_related', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novel_id')->unsigned()->nullable();
            $table->foreign('novel_id')->references('id')->on('novels');
            $table->integer('novel_to')->unsigned()->nullable();
            $table->foreign('novel_to')->references('id')->on('novels');
            $table->integer('type')->unsigned()->nullable();
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
        Schema::dropIfExists('novel_related');
    }
}
