<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('userimg')->default('/uploads/user/default.png');
            $table->string('banner')->nullable();
            $table->string('private')->nullable();
            $table->string('verified')->nullable();
            $table->integer('otomatis')->default(0);
            $table->string('opt_font')->default('Arial, Helvetica, sans-serif');
            $table->string('opt_size')->default('13');
            $table->string('opt_color')->default('#0000');
            $table->string('bio')->nullable();
            $table->string('gender')->nullable();
            $table->string('location')->nullable();
            $table->integer('type')->default(0);
            $table->integer('total_exp')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
