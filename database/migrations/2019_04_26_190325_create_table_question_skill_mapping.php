<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuestionSkillMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('questions_bank_skill', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('questions_bank_id')->unsigned();
		    $table->integer('skill_id')->unsigned();
		    $table->integer('max_score')->unsigned();
		    $table->enum('have_negative_marks', array('true', 'false'))->default('false');
		    $table->enum('count_in_overall_score', array('true', 'false'))->default('false');
		    $table->enum('count_in_skill_score', array('true', 'false'))->default('false');
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
        Schema::dropIfExists('questions_bank_skill');
    }
}
