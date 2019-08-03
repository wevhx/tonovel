<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ppl_name');
            $table->string('ppl_alt')->default('Awanampe');
            $table->string('ppl_slug')->unique();
            $table->string('ppl_country')->nullable();
            $table->integer('ppl_type')->default(0);
            $table->string('ppl_link')->nullable();
            $table->string('ppl_thumb')->default('/uploads/user/default.png');
            $table->string('ppl_bio')->nullable();
            $table->string('ppl_birthday')->nullable();
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
        Schema::dropIfExists('people');
    }
}
