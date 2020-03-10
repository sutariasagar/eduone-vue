<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersRolesPermissionsWithCreatedAndUpdatedBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::table('roles', function(Blueprint $table) {
		    if (!Schema::hasColumn('roles', 'created_by_id')) {
			    $table->integer('created_by_id')->unsigned()->nullable();
		    }
		    if (!Schema::hasColumn('roles', 'updated_by_id')) {
			    $table->integer('updated_by_id')->unsigned()->nullable();
		    }
	    });
	    Schema::table('permissions', function(Blueprint $table) {
		    if (!Schema::hasColumn('permissions', 'created_by_id')) {
			    $table->integer('created_by_id')->unsigned()->nullable();
		    }
		    if (!Schema::hasColumn('permissions', 'updated_by_id')) {
			    $table->integer('updated_by_id')->unsigned()->nullable();
		    }
	    });
	    Schema::table('users', function(Blueprint $table) {
		    if (!Schema::hasColumn('users', 'created_by_id')) {
			    $table->integer('created_by_id')->unsigned()->nullable();
		    }
		    if (!Schema::hasColumn('users', 'updated_by_id')) {
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
