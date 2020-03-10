<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ca1840bea560RelationshipsToExamSectionSubjectMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_section_subject_mappings', function(Blueprint $table) {
            if (!Schema::hasColumn('exam_section_subject_mappings', 'exam_section_id')) {
                $table->integer('exam_section_id')->unsigned()->nullable();
                $table->foreign('exam_section_id', '33263_5ca1840b69b9d')->references('id')->on('exam_sections')->onDelete('cascade');
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
        Schema::table('exam_section_subject_mappings', function(Blueprint $table) {
            
        });
    }
}
