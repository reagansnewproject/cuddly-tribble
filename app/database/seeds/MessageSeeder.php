<?php
class MessageSeeder extends Seeder {
	public function run() {
		$message1 = new Message();
		$message1->sender_id = 1;
		$message1->receiver_id = 2;
		$message1->message = "Hey!";
		$message1->is_read = "No";
		$message1->save();

		$message2 = new Message();
		$message2->sender_id = 2;
		$message2->receiver_id = 1;
		$message2->message = "Hey, yourself!";
		$message2->is_read = "No";
		$message2->save();

		$message3 = new Message();
		$message3->sender_id = 2;
		$message3->receiver_id = 1;
		$message3->message = "How can I help you?";
		$message3->is_read = "No";
		$message3->save();
	}
}
?>