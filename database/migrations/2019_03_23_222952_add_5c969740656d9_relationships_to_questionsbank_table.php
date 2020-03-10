<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c969740656d9RelationshipsToQuestionsBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions_banks', function(Blueprint $table) {
            if (!Schema::hasColumn('questions_banks', 'question_type_id')) {
                $table->integer('question_type_id')->unsigned()->nullable();
                $table->foreign('question_type_id', '32704_5c9693ff1119d')->references('id')->on('questions_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('questions_banks', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '32704_5c96973fd8971')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('questions_banks', 'updated_by_id')) {
                $table->integer('updated_by_id')->unsigned()->nullable();
                $table->foreign('updated_by_id', '32704_5c96973fdd504')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('questions_banks', function(Blueprint $table) {
            
        });
    }
}
