<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestionsWithPracticeSelection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('questions_banks', function (Blueprint $table) {
		    if (!Schema::hasColumn('questions_banks', 'include_in_free_package')) {                
                $table->enum('include_in_free_package', array('true', 'false'))->default('false');
            }
            if (!Schema::hasColumn('questions_banks', 'include_in_practice_set')) {                
                $table->enum('include_in_practice_set', array('true', 'false'))->default('false');
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
