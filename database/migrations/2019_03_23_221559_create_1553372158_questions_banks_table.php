<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1553372158QuestionsBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('questions_banks')) {
            Schema::create('questions_banks', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->text('header')->nullable();
                $table->integer('max_score')->nullable()->unsigned();
                $table->integer('preparation_time')->nullable()->unsigned();
                $table->integer('attempt_time')->nullable()->unsigned();
                $table->enum('status', array('active', 'inactive'))->nullable();
                $table->integer('min_words')->nullable()->unsigned();
                $table->integer('max_words')->nullable()->unsigned();
                
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
        Schema::dropIfExists('questions_banks');
    }
}
