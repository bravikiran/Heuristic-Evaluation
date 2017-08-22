<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluationlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heuristicrule');
            $table->text('note');
            $table->text('recommendation');
            $table->boolean('positive')->default(0);
            $table->integer('severity');
            $table->string('screenshot');
            $table->binary('referencescreenshot');
            $table->string('evaluator_email')->references('id')->on('projectlist');
            $table->integer('project_id')->references('id')->on('projectlist');
            $table->softDeletes();
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
        Schema::drop('evaluationlogs');
    }
}
