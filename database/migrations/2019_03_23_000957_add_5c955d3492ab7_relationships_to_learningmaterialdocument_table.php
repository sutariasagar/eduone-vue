<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c955d3492ab7RelationshipsToLearningMaterialDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learning_material_documents', function(Blueprint $table) {
            if (!Schema::hasColumn('learning_material_documents', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '32649_5c955d33e8345')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('learning_material_documents', 'updated_by_id')) {
                $table->integer('updated_by_id')->unsigned()->nullable();
                $table->foreign('updated_by_id', '32649_5c955d33ee799')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('learning_material_documents', 'learning_material_id')) {
                $table->integer('learning_material_id')->unsigned()->nullable();
                $table->foreign('learning_material_id', '32649_5c955d3400a33')->references('id')->on('learning_materials')->onDelete('cascade');
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
        Schema::table('learning_material_documents', function(Blueprint $table) {
            
        });
    }
}
