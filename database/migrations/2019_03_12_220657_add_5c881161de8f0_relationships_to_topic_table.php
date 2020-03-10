<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c881161de8f0RelationshipsToTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function(Blueprint $table) {
            if (!Schema::hasColumn('topics', 'course_id')) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', '31579_5c88113a6dcfc')->references('id')->on('courses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('topics', 'subject_id')) {
                $table->integer('subject_id')->unsigned()->nullable();
                $table->foreign('subject_id', '31579_5c88113a72d63')->references('id')->on('subjects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('topics', 'chapter_id')) {
                $table->integer('chapter_id')->unsigned()->nullable();
                $table->foreign('chapter_id', '31579_5c88113a77d2b')->references('id')->on('chapters')->onDelete('cascade');
                }
                if (!Schema::hasColumn('topics', 'parent_id')) {
                $table->integer('parent_id')->unsigned()->nullable();
                $table->foreign('parent_id', '31579_5c88116122fbf')->references('id')->on('topics')->onDelete('cascade');
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
        Schema::table('topics', function(Blueprint $table) {
            
        });
    }
}
