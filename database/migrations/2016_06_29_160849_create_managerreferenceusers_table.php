<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerreferenceusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managerreferenceusers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manager_id')->references('id')->on('users');
            $table->string('manager_email')->references('email')->on('users');
            $table->string('user_name');
            $table->string('user_email');
            $table->text('description');
            $table->string('user_role');
            $table->text('invitation_code');
            $table->text('invitation_link');
            $table->boolean('confirmed');
            $table->boolean('read');
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
       Schema::drop('managerreferenceusers');
    }
}
