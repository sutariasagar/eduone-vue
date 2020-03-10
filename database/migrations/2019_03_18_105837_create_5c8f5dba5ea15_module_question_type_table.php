<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c8f5dba5ea15ModuleQuestionTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('module_question_type')) {
            Schema::create('module_question_type', function (Blueprint $table) {
                $table->integer('module_id')->unsigned()->nullable();
                $table->foreign('module_id', 'fk_p_32124_32123_question_5c8f5dba5eb04')->references('id')->on('modules')->onDelete('cascade');
                $table->integer('question_type_id')->unsigned()->nullable();
                $table->foreign('question_type_id', 'fk_p_32123_32124_module_q_5c8f5dba5eb54')->references('id')->on('question_types')->onDelete('cascade');
                
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
        Schema::dropIfExists('module_question_type');
    }
}
