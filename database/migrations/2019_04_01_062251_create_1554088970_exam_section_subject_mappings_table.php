<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1554088970ExamSectionSubjectMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('exam_section_subject_mappings')) {
            Schema::create('exam_section_subject_mappings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('min_questions')->nullable()->unsigned();
                $table->integer('max_questions')->nullable()->unsigned();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_section_subject_mappings');
    }
}
