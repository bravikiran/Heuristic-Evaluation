<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluationresults', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heuristicrule');
            $table->text('note');
            $table->text('recommendation');
            $table->integer('severity');
            $table->binary('screenshot');
            $table->binary('referencescreenshot');
            $table->integer('project_id')->references('id')->on('projectlist');
            $table->string('tracking');
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
        Schema::drop('evaluationresults');
    }
}
