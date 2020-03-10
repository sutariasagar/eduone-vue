<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c9693ff9cc69RelationshipsToQuestionsBankTable extends Migration
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
