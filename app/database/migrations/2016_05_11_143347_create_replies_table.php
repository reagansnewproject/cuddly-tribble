<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('replies', function($table) {
			$table->increments('id');
			$table->text('body');
			$table->integer('message_id')->unsigned();
			$table->foreign('message_id')->references('id')->on('messages');
			$table->integer('responder_id')->unsigned();
			$table->foreign('responder_id')->references('id')->on('users');
			$table->integer('receiver_id')->unsigned();
			$table->foreign('receiver_id')->references('id')->on('users');
			$table->string('is_read');
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
		Schema::drop('replies');
	}

}
