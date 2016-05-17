<?php
class MessageController extends BaseController {

	public function inbox() {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			$receivedmessages = DB::table('messages')->where('receiver_id', Auth::id())->get();
			$sentmessages = DB::table('messages')->where('sender_id', Auth::id())->get();
			$sentreplies = DB::table('replies')->where('responder_id', Auth::id())->get();
			$receivedreplies = DB::table('replies')->where('receiver_id', Auth::id())->get();
			return View::make('messages.inbox')->with('receivedmessages', $receivedmessages)->with('sentmessages', $sentmessages)->with('sentreplies', $sentreplies)->with('receivedreplies', $receivedreplies);
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to read your messages!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function showmessage($message_id, $person_id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			$otherperson = User::find($person_id);
			$message = Message::find($message_id);
			$replies = DB::table('replies')->where('message_id', $message->id)->get();
			if(Auth::id() == $message->receiver_id || Auth::id() == $message->sender_id) {
				if(Auth::id() == $message->receiver_id) {
					$message->is_read = "Yes";
					$message->save();
				}
				if($replies != null) {
					foreach($replies as $reply) {
						$replyupdate = Reply::find($reply->id);
						if(Auth::id() == $replyupdate->receiver_id) {
							$replyupdate->is_read = "Yes";
							$replyupdate->save();
						}
					}
				}
				return View::make('messages.show')->with('message', $message)->with('replies', $replies)->with('otherperson', $otherperson);
			} else {
				Session::flash('errorMessage', 'You are not authorized to view this message!');
				return Redirect::back();
			}
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to view a message!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function reply($message_id, $person_id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			$message = Message::find($message_id);
			if(Auth::id() == $message->receiver_id || Auth::id() == $message->sender_id) {
				$reply = new Reply();
				$reply->message_id = $message->id;
				$reply->responder_id = Auth::id();
				$reply->receiver_id = $person_id;
				$reply->is_read = "No";
				$reply->body = Input::get('body');
				$reply->save();
				$getter = User::find($message->receiver_id);
				$sender = User::find($message->sender_id);
				$receiver_email = $getter->email;
				$receiver_username = $getter->username;
				$sender_username = $sender->username;
				$data = array('receiver_email' => $receiver_email, 'receiver_username' => $receiver_username, 'sender_username' => $sender_username);
				Mail::send('emails.newmessage', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');
					$message->to($data['receiver_email']);
					$message->subject($data['sender_username'] . " replied to your message!");
				});
				Session::flash('successMessage', 'You have successfully replied to this message');
				return Redirect::action('MessageController@inbox');
			} else {
				Session::flash('errorMessage', 'You are not authorized to respond to this message!');
				return Redirect::back();
			}
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to respond to a message!');
			return Redirect::action('UsersController@showlogin');
		}
	}
	public function contactmember($id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			$user = User::find($id);
			return View::make('messages.contactmember')->with('user', $user);
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to send a message!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function sendmessage($id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			$message = new Message();
			$message->message = Input::get('message');
			$message->sender_id = Auth::id();
			$message->receiver_id = $id;
			$message->is_read = "No";
			$message->save();
			$getter = User::find($message->receiver_id);
			$sender = User::find($message->sender_id);
			$receiver_email = $getter->email;
			$receiver_username = $getter->username;
			$sender_username = $sender->username;
			$data = array('receiver_email' => $receiver_email, 'receiver_username' => $receiver_username, 'sender_username' => $sender_username);
			Mail::send('emails.newmessage', array('data' => $data), function($message) use ($data) {
				$message->from('reagan@screenlight.com', 'Screenlight Dating');

				$message->to($data['receiver_email']);

				$message->subject($data['sender_username'] . " sent you a message!");

			});
			Session::flash('successMessage', 'Your message has been sent');
			return Redirect::action('UsersController@profile', $id);
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to send a message!');
			return Redirect::action('UsersController@showlogin');
		}
	}
}
?>