<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevelopercommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('developercomments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->references('id')->on('developerprojectlist');
            $table->integer('log_id')->references('id')->on('evaluationresults');
            $table->string('user_email');
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
        Schema::drop('developercomments');
    }
}
