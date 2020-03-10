<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToExamSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_sections', function (Blueprint $table) {
            if (!Schema::hasColumn('exam_sections', 'exam_id')) {
                $table->integer('exam_id')->unsigned()->nullable();
                $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
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
        Schema::table('exam_sections', function (Blueprint $table) {

        });
    }
}
