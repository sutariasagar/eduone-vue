<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c955a86c54d5RelationshipsToQuestionTypeTable extends Migration
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
                if (!Schema::hasColumn('question_types', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '32123_5c955a864646a')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('question_types', 'updated_by_id')) {
                $table->integer('updated_by_id')->unsigned()->nullable();
                $table->foreign('updated_by_id', '32123_5c955a864a0cd')->references('id')->on('users')->onDelete('cascade');
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
