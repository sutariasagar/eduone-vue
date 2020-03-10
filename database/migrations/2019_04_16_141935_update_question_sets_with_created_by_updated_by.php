<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestionSetsWithCreatedByUpdatedBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::table('question_sets', function(Blueprint $table) {
		    if (!Schema::hasColumn('question_sets', 'created_by_id')) {
			    $table->integer('created_by_id')->unsigned()->nullable();
			    $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
		    }
		    if (!Schema::hasColumn('question_sets', 'updated_by_id')) {
			    $table->integer('updated_by_id')->unsigned()->nullable();
			    $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
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
