<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matches', function($table) {
			$table->increments('id');
			$table->integer('person1_id')->unsigned();
			$table->foreign('person1_id')->references('id')->on('users');
			$table->integer('person2_id')->unsigned();
			$table->foreign('person2_id')->references('id')->on('users');
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
		Schema::drop('matches');
	}

}
