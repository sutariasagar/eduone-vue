<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFieldsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name')->nullable()->change();
            }
            if (Schema::hasColumn('users', 'middle_name')) {
                $table->string('middle_name')->nullable()->change();
            }
            if (Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->nullable()->change();
            }
            if (Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->change();
            }
            if (Schema::hasColumn('users', 'country')) {
                $table->string('country')->nullable()->change();
            }
            if (Schema::hasColumn('users', 'state')) {
                $table->string('state')->nullable()->change();
            }
            if (Schema::hasColumn('users', 'city')) {
                $table->string('city')->nullable()->change();
            }
            if (Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable()->change();
            }
            if (Schema::hasColumn('users', 'type')) {
                $table->string('type')->nullable()->change();
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
