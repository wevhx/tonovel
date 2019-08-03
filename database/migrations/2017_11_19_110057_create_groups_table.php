<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('thumb')->nullable();
            $table->string('backg')->nullable();
            $table->string('name')->default('Awanama');
            $table->string('slug')->unique();
            $table->string('url')->nullable();
            $table->string('description')->nullable();
            $table->string('privatekey')->nullable();
            $table->string('rightclick')->nullable();
            $table->string('adsbox')->nullable();
            $table->string('member')->nullable();
            $table->integer('staff')->unsigned()->nullable();
            $table->foreign('staff')->references('id')->on('users');
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
        Schema::dropIfExists('groups');
    }
}
