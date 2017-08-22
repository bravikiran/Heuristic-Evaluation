<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitledescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titledescription', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('description');
            $table->integer('rules_id')->unsigned();
            $table->foreign('rules_id')->references('id')->on('heuristicrules');
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
        Schema::drop('titledescription');
    }
}
