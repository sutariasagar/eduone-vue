<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateExamSectionSubjectMappingWithRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::table('exam_section_subject_mappings', function(Blueprint $table) {
		    if (!Schema::hasColumn('exam_section_subject_mappings', 'chapter_id')) {
			    $table->integer('chapter_id')->unsigned()->nullable();
			    $table->foreign('chapter_id')->references('id')->on('chapters');
		    }
		    if (!Schema::hasColumn('exam_section_subject_mappings', 'topic_id')) {
			    $table->integer('topic_id')->unsigned()->nullable();
			    $table->foreign('topic_id')->references('id')->on('topics');
		    }
		    if (!Schema::hasColumn('exam_section_subject_mappings', 'sub_topic_id')) {
			    $table->integer('sub_topic_id')->unsigned()->nullable();
			    $table->foreign('sub_topic_id')->references('id')->on('topics');
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
