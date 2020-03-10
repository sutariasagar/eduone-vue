<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8f5dbb07e8eRelationshipsToQuestionTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_types', function(Blueprint $table) {
            if (!Schema::hasColumn('question_types', 'skill_id')) {
                $table->integer('skill_id')->unsigned()->nullable();
                $table->foreign('skill_id', '32123_5c8f5ccff12aa')->references('id')->on('skills')->onDelete('cascade');
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
        Schema::table('question_types', function(Blueprint $table) {
            
        });
    }
}
