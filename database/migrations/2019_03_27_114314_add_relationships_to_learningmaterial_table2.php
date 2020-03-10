<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToLearningmaterialTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learning_materials', function (Blueprint $table) {
           if (!Schema::hasColumn('learning_materials', 'sub_topic_id')) {
            $table->integer('sub_topic_id')->unsigned()->nullable();
	           $table->foreign('sub_topic_id')->references('id')->on('topics')->onDelete('cascade');
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
