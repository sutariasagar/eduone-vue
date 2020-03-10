<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c955bdfacebbRelationshipsToLearningMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learning_materials', function(Blueprint $table) {
            if (!Schema::hasColumn('learning_materials', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '32648_5c955bdf298fc')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('learning_materials', 'updated_by_id')) {
                $table->integer('updated_by_id')->unsigned()->nullable();
                $table->foreign('updated_by_id', '32648_5c955bdf2f646')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('learning_materials', function(Blueprint $table) {
            
        });
    }
}
