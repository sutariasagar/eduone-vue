<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c9696ee3e757RelationshipsToExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams', function(Blueprint $table) {
            if (!Schema::hasColumn('exams', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '32709_5c9696ed9c83d')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('exams', 'updated_by_id')) {
                $table->integer('updated_by_id')->unsigned()->nullable();
                $table->foreign('updated_by_id', '32709_5c9696eda244a')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('exams', function(Blueprint $table) {
            
        });
    }
}
