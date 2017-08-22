<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectlist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('projectname');
            $table->string('projectlink');
            $table->text('Description');
            $table->string('requiredrules');
            $table->dateTime('date');
            $table->string('manager_email')->references('id')->on('users');
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
        Schema::drop('projectlist');
    }
}
