<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1553372668ExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('exams')) {
            Schema::create('exams', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->enum('question_pool', array('random', 'static'))->nullable();
                $table->integer('total_marks')->nullable()->unsigned();
                $table->integer('passing_marks')->nullable()->unsigned();
                $table->integer('duration')->nullable()->unsigned();
                $table->enum('status', array('active', 'inactive'))->nullable();
                $table->text('start_instructions')->nullable();
                $table->text('end_instructions')->nullable();
                $table->string('exam_type')->nullable();
                $table->integer('sections_count')->nullable()->unsigned();
                $table->tinyInteger('can_see_solution')->nullable()->default('0');
                $table->string('instruction_type')->nullable();
                
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
        Schema::dropIfExists('exams');
    }
}
