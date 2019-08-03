<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelPublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novel_publisher', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novel_id')->unsigned()->nullable();
            $table->foreign('novel_id')->references('id')->on('novels');
            $table->integer('publisher_id')->unsigned()->nullable();
            $table->foreign('publisher_id')->references('id')->on('publishers');
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
        Schema::dropIfExists('novel_publisher');
    }
}
