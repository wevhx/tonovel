<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupNovelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_novel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->integer('novel_id')->unsigned();
            $table->foreign('novel_id')->references('id')->on('novels');
            $table->integer('status')->default(1);
            $table->integer('manager')->unsigned();
            $table->foreign('manager')->references('id')->on('users');
            $table->string('team')->nullable();
            $table->string('editor')->nullable();
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
        Schema::dropIfExists('group_projects');
    }
}
