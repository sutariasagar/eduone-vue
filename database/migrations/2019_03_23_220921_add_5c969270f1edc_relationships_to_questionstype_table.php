<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c969270f1edcRelationshipsToQuestionsTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions_types', function(Blueprint $table) {
            if (!Schema::hasColumn('questions_types', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '32703_5c9692705979c')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('questions_types', 'updated_by_id')) {
                $table->integer('updated_by_id')->unsigned()->nullable();
                $table->foreign('updated_by_id', '32703_5c96927070903')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('questions_types', function(Blueprint $table) {
            
        });
    }
}
