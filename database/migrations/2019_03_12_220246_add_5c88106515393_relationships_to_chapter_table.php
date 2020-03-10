<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c88106515393RelationshipsToChapterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chapters', function(Blueprint $table) {
            if (!Schema::hasColumn('chapters', 'course_id')) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', '31578_5c8810648a37b')->references('id')->on('courses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('chapters', 'subject_id')) {
                $table->integer('subject_id')->unsigned()->nullable();
                $table->foreign('subject_id', '31578_5c8810648eed8')->references('id')->on('subjects')->onDelete('cascade');
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
        Schema::table('chapters', function(Blueprint $table) {
            
        });
    }
}
