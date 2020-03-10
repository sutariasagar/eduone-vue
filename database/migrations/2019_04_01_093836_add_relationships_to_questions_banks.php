<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToQuestionsBanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions_banks', function (Blueprint $table) {
            if (!Schema::hasColumn('questions_banks', 'course_id')) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('questions_banks', 'subject_id')) {
                $table->integer('subject_id')->unsigned()->nullable();
                $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('questions_banks', 'chapter_id')) {
                $table->integer('chapter_id')->unsigned()->nullable();
                $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
                }
                if (!Schema::hasColumn('questions_banks', 'topic_id')) {
                $table->integer('topic_id')->unsigned()->nullable();
                $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
                }
                if (!Schema::hasColumn('questions_banks', 'sub_topic_id')) {
                $table->integer('sub_topic_id')->unsigned()->nullable();
	                $table->foreign('sub_topic_id')->references('id')->on('topics')->onDelete('cascade');
                }
                if (!Schema::hasColumn('questions_banks', 'answer_type_id')) {
                $table->integer('answer_type_id')->unsigned()->nullable();
                $table->foreign('answer_type_id')->references('id')->on('answers_types')->onDelete('cascade');
                }
                // if (!Schema::hasColumn('questions_banks', 'question_type_id')) {
                // $table->integer('question_type_id')->unsigned()->nullable();
                // $table->foreign('question_type_id', '32704_5c9693ff1119d')->references('id')->on('questions_types')->onDelete('cascade');
                // }
                // if (!Schema::hasColumn('questions_banks', 'question_type_id')) {
                // $table->integer('question_type_id')->unsigned()->nullable();
                // $table->foreign('question_type_id', '32704_5c9693ff1119d')->references('id')->on('questions_types')->onDelete('cascade');
                // }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions_banks', function (Blueprint $table) {

        });
    }
}
