<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLearningMaterialWithPracticeSelection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('learning_material_documents', function (Blueprint $table) {
		    if (!Schema::hasColumn('learning_material_documents', 'include_in_free_package')) {
			    $table->enum('include_in_free_package', array('true', 'false'))->default('false');
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
