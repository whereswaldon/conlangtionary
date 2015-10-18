<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('definitions', function($table) {
            $table->increments('id');
            $table->integer('definition_number')->unsigned();
            $table->text('definition_text');
            $table->integer('word_id')->unsigned();
            $table->foreign('word_id')->references('id')->on('words');
            $table->text('notes')->default('');
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('definitions');
    }
}
