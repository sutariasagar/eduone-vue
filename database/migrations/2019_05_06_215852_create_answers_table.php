<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('exam_id')->unsigned();
	        $table->integer('user_id')->unsigned();
	        $table->integer('question_id')->unsigned();
	        $table->text('answer')->nullable()->default(null);
	        $table->text('user_answer')->nullable()->default(null);
	        //$table->string('filename')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
