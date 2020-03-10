<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1554088772ExamSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('exam_sections')) {
            Schema::create('exam_sections', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->integer('min_questions')->nullable()->unsigned();
                $table->integer('max_questions')->nullable()->unsigned();
                $table->string('timer')->nullable();
                $table->tinyInteger('is_subsection')->nullable()->default('0');
                $table->integer('min_time')->nullable()->unsigned();
                $table->integer('max_time')->nullable()->unsigned();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_sections');
    }
}
