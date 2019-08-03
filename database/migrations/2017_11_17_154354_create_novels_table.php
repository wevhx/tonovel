<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    // Atribute
    // id = int
    // title = string
    // alt_tile = string
    // slug = string
    // type = int
    // country = string
    // thumb = string
    // blurred = string
    // total = int
    // status = int
    // synopsis = string
    // year = int
    // artist = int
    // author = string/json
    // coo = string
    // enpub = string/json
    // onpub = string/json
    // licensed = string
    // completely_translated = string
    // orginal_publisher = string
    // english_publisher = string
    // release frequency = string
    // views = int
    // total_views = int
    public function up()
    {
        Schema::create('novels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('N/A');
            $table->string('alt_title')->default('N/A');
            $table->string('slug')->unique();
            $table->integer('type')->default('0');
            $table->string('country')->default('ID');
            $table->string('thumb')->default('/img/noimg.png');
            $table->string('blurred')->default('/img/nobg.png');
            $table->integer('total')->nullable();
            $table->integer('status')->default('0');
            $table->longText('synopsis',9999);
            $table->integer('year')->default('2017');
            //$table->integer('artist')->unsigned()->nullable();
            //$table->integer('author')->unsigned()->nullable();
            $table->string('coo')->default('N/A');
            //$table->string('enpub')->default('N/A');;
            //$table->string('onpub')->default('N/A');;
            $table->string('licensed')->default('N/A');;
            $table->string('completely_translated')->default('N/A');
            //$table->string('orginal_publisher')->default('N/A');;
            //$table->string('english_publisher')->default('N/A');;
            $table->string('release_frequency')->default('N/A');
            $table->integer('views');
            $table->integer('total_views');
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
        Schema::dropIfExists('novels');
    }
}
