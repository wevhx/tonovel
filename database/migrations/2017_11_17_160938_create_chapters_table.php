<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novel_id')->unsigned()->nullable();
            $table->foreign('novel_id')->references('id')->on('novels');
            $table->string('numba')->nullable();
            $table->string('title')->default('Tanpa judul');
            $table->string('desc')->default('Tanpa Deskripsi');
            $table->longText('content')->nullable();
            $table->string('volume')->default(0);
            $table->integer('group_id')->unsigned()->nullable();
            $table->integer('views')->default(0);
            $table->integer('total_views')->default(0);
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
        Schema::dropIfExists('chapters');
    }
}
