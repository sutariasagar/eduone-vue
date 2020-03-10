<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToLearningmaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learning_materials', function (Blueprint $table) {
            if (!Schema::hasColumn('learning_materials', 'course_id')) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('learning_materials', 'subject_id')) {
                $table->integer('subject_id')->unsigned()->nullable();
                $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('learning_materials', 'chapter_id')) {
                $table->integer('chapter_id')->unsigned()->nullable();
                $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
                }
                if (!Schema::hasColumn('learning_materials', 'topic_id')) {
                $table->integer('topic_id')->unsigned()->nullable();
                $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
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
        Schema::table('learning_materials', function (Blueprint $table) {

        });
    }
}
