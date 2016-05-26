<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('details', function($table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('introduction');
			$table->text('about_me');
			$table->string('personality');
			$table->string('marital_status');
			$table->string('children');
			$table->string('want_children');
			$table->string('religion');
			$table->string('politics');
			$table->string('job');
			$table->string('income');
			$table->string('hair_color');
			$table->string('hair_length');
			$table->string('eye_color');
			$table->string('body_type');
			$table->string('height');
			$table->string('weight');
			$table->string('can_host');
			$table->string('availability_day');
			$table->string('availability_time');
			$table->text('other_features');
			$table->text('ideal');
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
		Schema::drop('details');
	}

}
