<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIcebreakersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('icebreakers', function($table) {
			$table->increments('id');
			$table->integer('sender_id')->unsigned();
			$table->foreign('sender_id')->references('id')->on('users');
			$table->integer('receiver_id')->unsigned();
			$table->foreign('receiver_id')->references('id')->on('users');
			$table->integer('question1_id')->unsigned();
			$table->foreign('question1_id')->references('id')->on('questions');
			$table->integer('question2_id')->unsigned();
			$table->foreign('question2_id')->references('id')->on('questions');
			$table->integer('question3_id')->unsigned();
			$table->foreign('question3_id')->references('id')->on('questions');
			$table->text('question1_answer')->nullable();
			$table->text('question2_answer')->nullable();
			$table->text('question3_answer')->nullable();
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
		Schema::drop('icebreakers');
	}

}
