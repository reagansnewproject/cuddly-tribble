<?php
class UsersSeeder extends Seeder {
	public function run() {
		$user1 = new User();
		$user1->username = "Reaganagaer";
		$user1->email = "reagan.wilkins@gmail.com";
		$user1->gender = "Male";
		$user1->ethnicity = "Caucasian";
		$user1->preference = "Women";
		$user1->birthday = "April 13, 1993";
		$user1->state = "TX";
		$user1->city = "San Antonio";
		$user1->zipcode = "78209";
		$user1->willing = "No";
		$user1->password = Hash::make('test');
		$user1->save();

		$user2 = new User();
		$user2->username = "A Girl";
		$user2->email = "averagegirl92@gmail.com";
		$user2->gender = "Female";
		$user2->ethnicity = "Caucasian";
		$user2->preference = "Men";
		$user2->birthday = "January 1, 1992";
		$user2->state = "TX";
		$user2->city = "San Antonio";
		$user2->zipcode = "78209";
		$user2->willing = "No";
		$user2->password = Hash::make('blah');
		$user2->save();
	}
}
?>