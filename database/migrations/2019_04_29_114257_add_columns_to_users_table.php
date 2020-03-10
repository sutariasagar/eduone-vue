<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'first_name')) {
			    $table->string('first_name');
            }
            if (!Schema::hasColumn('users', 'middle_name')) {
			    $table->string('middle_name');
            }
            if (!Schema::hasColumn('users', 'last_name')) {
			    $table->string('last_name');
            }
            if (!Schema::hasColumn('users', 'phone')) {
			    $table->string('phone');
            }
            if (!Schema::hasColumn('users', 'country')) {
			    $table->string('country');
            }
            if (!Schema::hasColumn('users', 'state')) {
			    $table->string('state');
            }
            if (!Schema::hasColumn('users', 'city')) {
			    $table->string('city');
            }
            
            if (!Schema::hasColumn('users', 'package_id')) {
                $table->integer('package_id')->unsigned()->nullable();
                $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
