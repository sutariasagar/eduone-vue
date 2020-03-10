<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1553292595LearningMaterialDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('learning_material_documents')) {
            Schema::create('learning_material_documents', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('material_type')->nullable();
                $table->string('link')->nullable();
                $table->integer('priority')->nullable()->unsigned();
                $table->enum('mandatory', array('yes', 'no'))->nullable();
                $table->integer('credits')->nullable()->unsigned();
                
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
        Schema::dropIfExists('learning_material_documents');
    }
}
