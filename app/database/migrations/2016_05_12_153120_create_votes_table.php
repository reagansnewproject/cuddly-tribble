<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('votes', function($table) {
			$table->increments('id');
			$table->integer('subject_id')->unsigned();
			$table->foreign('subject_id')->references('id')->on('users');
			$table->integer('voter_id')->unsigned();
			$table->foreign('voter_id')->references('id')->on('users');
			$table->string('vote');
			$table->timestamps();
		}) ;
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('votes');
	}

}
