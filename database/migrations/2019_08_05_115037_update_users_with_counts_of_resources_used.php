<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersWithCountsOfResourcesUsed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
		    if (!Schema::hasColumn('users', 'tests_with_assessment')) {
			    $table->integer('tests_with_assessment')->default(0);
            } 
            if (!Schema::hasColumn('users', 'video_tutorials')) {
			    $table->integer('video_tutorials')->default(0);
            }
            if (!Schema::hasColumn('users', 'practice_questions')) {
			    $table->integer('practice_questions')->default(0);
            }
            if (!Schema::hasColumn('users', 'mock_tests')) {
			    $table->integer('mock_tests')->default(0);
            }
            if (!Schema::hasColumn('users', 'pte_vouchers')) {
			    $table->integer('pte_vouchers')->default(0);
            }
            if (!Schema::hasColumn('users', 'webinar_sessions')) {
			    $table->integer('webinar_sessions')->default(0);
            }
            if (!Schema::hasColumn('users', 'personal_feedback_and_assessment')) {
			    $table->string('personal_feedback_and_assessment',20)->default('true')->nullable();
            }
            if (!Schema::hasColumn('users', 'coaching_session_daily')) {
			    $table->integer('coaching_session_daily')->default(0);
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
