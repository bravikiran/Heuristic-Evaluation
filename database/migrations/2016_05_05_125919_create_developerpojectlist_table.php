<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeveloperpojectlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developerprojectlist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('devemail')->references('id')->on('users');
            $table->integer('project_id')->references('id')->on('projectlist');
            $table->text('comment');
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
        Schema::drop('developerprojectlist');
    }
}
