<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectusers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('evaemail')->references('id')->on('users');
            $table->integer('project_id')->references('id')->on('projectlist');
            $table->integer('acceptreject');
            $table->integer('pendingfinished');
            $table->integer('request');
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
        Schema::drop('projectusers');
    }
}
