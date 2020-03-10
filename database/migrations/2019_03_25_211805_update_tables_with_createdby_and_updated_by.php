<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTablesWithCreatedbyAndUpdatedBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::table('industries', function(Blueprint $table) {
		    if (!Schema::hasColumn('industries', 'created_by_id')) {
			    $table->integer('created_by_id')->unsigned()->nullable();
		    }
		    if (!Schema::hasColumn('industries', 'updated_by_id')) {
			    $table->integer('updated_by_id')->unsigned()->nullable();
		    }
	    });
	    Schema::table('courses', function(Blueprint $table) {
		    if (!Schema::hasColumn('courses', 'created_by_id')) {
			    $table->integer('created_by_id')->unsigned()->nullable();
		    }
		    if (!Schema::hasColumn('courses', 'updated_by_id')) {
			    $table->integer('updated_by_id')->unsigned()->nullable();
		    }
	    });
	    Schema::table('subjects', function(Blueprint $table) {
		    if (!Schema::hasColumn('subjects', 'created_by_id')) {
			    $table->integer('created_by_id')->unsigned()->nullable();
		    }
		    if (!Schema::hasColumn('subjects', 'updated_by_id')) {
			    $table->integer('updated_by_id')->unsigned()->nullable();
		    }
	    });
	    Schema::table('chapters', function(Blueprint $table) {
		    if (!Schema::hasColumn('chapters', 'created_by_id')) {
			    $table->integer('created_by_id')->unsigned()->nullable();
		    }
		    if (!Schema::hasColumn('chapters', 'updated_by_id')) {
			    $table->integer('updated_by_id')->unsigned()->nullable();
		    }
	    });
	    Schema::table('topics', function(Blueprint $table) {
		    if (!Schema::hasColumn('topics', 'created_by_id')) {
			    $table->integer('created_by_id')->unsigned()->nullable();
		    }
		    if (!Schema::hasColumn('topics', 'updated_by_id')) {
			    $table->integer('updated_by_id')->unsigned()->nullable();
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
        //
    }
}
