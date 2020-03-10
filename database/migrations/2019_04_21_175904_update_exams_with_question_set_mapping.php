<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateExamsWithQuestionSetMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::table('exams', function (Blueprint $table) {
		    if (!Schema::hasColumn('exams', 'question_set_id')) {
			    $table->integer('question_set_id')->unsigned()->nullable();
			    $table->foreign('question_set_id')->references('id')->on('exams');
		    }
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
