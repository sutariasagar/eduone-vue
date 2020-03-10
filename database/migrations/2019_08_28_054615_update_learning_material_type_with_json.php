<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLearningMaterialTypeWithJson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //learning_material_documents

        Schema::table('learning_material_documents', function (Blueprint $table) {
		    if (Schema::hasColumn('learning_material_documents', 'material_type')) {
                DB::statement('ALTER TABLE `learning_material_documents` CHANGE `material_type` `material_type` JSON NULL DEFAULT NULL;');
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
