<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		DB::table('messages')->delete();
		DB::table('users')->delete();


		// $this->call('UserTableSeeder');
		$this->call('UsersSeeder');
		$this->call('MessageSeeder');
	}

}
