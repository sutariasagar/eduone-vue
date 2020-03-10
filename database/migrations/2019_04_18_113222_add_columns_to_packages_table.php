<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            if (!Schema::hasColumn('packages', 'tests_with_assessment')) {
			    $table->integer('tests_with_assessment')->nullable()->unsigned();
            }
            if (!Schema::hasColumn('packages', 'video_tutorials')) {
			    $table->integer('video_tutorials')->nullable()->unsigned();
            }
            if (!Schema::hasColumn('packages', 'practice_questions')) {
			    $table->integer('practice_questions')->nullable()->unsigned();
            }
            if (!Schema::hasColumn('packages', 'mock_tests')) {
			    $table->integer('mock_tests')->nullable()->unsigned();
            }
            if (!Schema::hasColumn('packages', 'pte_vouchers')) {
			    $table->integer('pte_vouchers')->nullable()->unsigned();
            }
            if (!Schema::hasColumn('packages', 'webinar_sessions')) {
			    $table->integer('webinar_sessions')->nullable()->unsigned();
            }
            if (!Schema::hasColumn('packages', 'personal_feedback_and_assessment')) {
			    $table->enum('personal_feedback_and_assessment', array('true', 'false'))->nullable();
            }
            if (!Schema::hasColumn('packages', 'coaching_session_daily')) {
			    $table->integer('coaching_session_daily')->nullable()->unsigned();
            }
            if (!Schema::hasColumn('packages', 'unique_package_name')) {
			    $table->string('unique_package_name');
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
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
}
