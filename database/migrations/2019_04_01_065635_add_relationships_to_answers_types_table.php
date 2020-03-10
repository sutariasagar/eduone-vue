<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToAnswersTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers_types', function(Blueprint $table) {
            if (!Schema::hasColumn('answers_types', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('answers_types', 'updated_by_id')) {
                $table->integer('updated_by_id')->unsigned()->nullable();
                $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('answers_types', function(Blueprint $table) {
            
        });
    }
}
