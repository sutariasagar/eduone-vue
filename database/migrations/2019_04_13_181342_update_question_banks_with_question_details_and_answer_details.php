<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestionBanksWithQuestionDetailsAndAnswerDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::table('questions_banks', function(Blueprint $table) {
		    if ( ! Schema::hasColumn( 'questions_banks', 'question_details' ) ) {
			    $table->json( 'question_details' )->nullable();
		    }
		    if ( ! Schema::hasColumn( 'questions_banks', 'answer_details' ) ) {
			    $table->json( 'answer_details' )->nullable();
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
