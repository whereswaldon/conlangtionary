<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function ($table) {
		$table->increments('id');
		$table->text('ascii_string');
		$table->integer('language_id')->unsigned();
		$table->foreign('language_id')->references('id')->on('languages');
        $table->text('notes')->default('');
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
        Schema::drop('words');
    }
}
