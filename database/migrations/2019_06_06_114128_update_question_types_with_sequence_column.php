<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestionTypesWithSequenceColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //questions_types
	    Schema::table('questions_types', function (Blueprint $table) {
		    if (!Schema::hasColumn('questions_types', 'sequence')) {
			    $table->integer('sequence')->unsigned()->default(0);
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