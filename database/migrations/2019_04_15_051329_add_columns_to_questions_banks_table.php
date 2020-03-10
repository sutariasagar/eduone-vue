<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToQuestionsBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions_banks', function (Blueprint $table) {
            if (!Schema::hasColumn('questions_banks', 'solution_html')) {
                $table->text('solution_html')->nullable();
            }
            if (!Schema::hasColumn('questions_banks', 'section_type')) {
                $table->enum('section_type', array('speaking', 'writing','reading','listening_sst','listening_rol'))->nullable();
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
        Schema::table('questions_banks', function (Blueprint $table) {
            //
        });
    }
}
