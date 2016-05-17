<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('username', 100);
			$table->string('email');
			$table->string('gender');
			$table->string('ethnicity');
			$table->string('preference');
			$table->string('birthday');
			$table->string('state');
			$table->string('city');
			$table->string('zipcode');
			$table->string('willing');
			$table->string('password');
			$table->string('code');
			$table->string('is_verified');
			$table->string('image_url');
			$table->string('online');
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
