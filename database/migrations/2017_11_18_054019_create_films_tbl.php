<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films_tbl', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('film_id');
            $table->string('name');
            $table->longText('desc');
            $table->date('release_date');
            $table->string('ticket_price');
            $table->string('country');
            $table->longText('photo_url');
            $table->integer('rating');
            $table->longText('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films_tbl');
    }
}
