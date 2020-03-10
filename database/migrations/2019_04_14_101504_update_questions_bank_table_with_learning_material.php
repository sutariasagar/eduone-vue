<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestionsBankTableWithLearningMaterial extends Migration
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
		    if ( ! Schema::hasColumn( 'questions_banks', 'learning_material_id' ) ) {
			    $table->integer('learning_material_id')->unsigned()->nullable();
			    $table->foreign('learning_material_id')->references('id')->on('learning_materials');
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
