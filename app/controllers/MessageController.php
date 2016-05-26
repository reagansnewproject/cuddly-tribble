<?php
class MessageController extends BaseController {

	public function inbox() {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
			$receivedmessages = DB::table('messages')->where('receiver_id', Auth::id())->get();
			$sentmessages = DB::table('messages')->where('sender_id', Auth::id())->get();
			$sentreplies = DB::table('replies')->where('responder_id', Auth::id())->get();
			$receivedreplies = DB::table('replies')->where('receiver_id', Auth::id())->get();
			$senticebreakers = DB::table('icebreakers')->where('sender_id', Auth::id())->get();
			$receivedicebreakers = DB::table('icebreakers')->where('receiver_id', Auth::id())->get();
			return View::make('messages.inbox')->with('receivedmessages', $receivedmessages)->with('sentmessages', $sentmessages)->with('sentreplies', $sentreplies)->with('receivedreplies', $receivedreplies)->with('senticebreakers', $senticebreakers)->with('receivedicebreakers', $receivedicebreakers);
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to read your messages!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function showmessage($message_id, $person_id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
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
				User::record();
				Session::flash('errorMessage', 'You are not authorized to view this message!');
				$breach = new Breach();
				$url = Request::url();
				$request = Request::method();
				$breach->url = $url;
				$breach->request = $request;
				$breach->user_id = Auth::id();
				$breach->ip_address = $_SERVER["REMOTE_ADDR"];
				$breach->browser = $_SERVER["HTTP_USER_AGENT"];
				$breach->email = Auth::user()->email;
				$breach->offense = "Attempted to view another user's messages: Message id: " . $message->id;
				$breach->save();
				$email = Auth::user()->email;
				$username = Auth::user()->username;
				$offense = "Attempted to view another user's messages";
				$browser = $_SERVER["HTTP_USER_AGENT"];
				$ip = $_SERVER["REMOTE_ADDR"];
				$data = array('id' => $id, 'email' => $email, 'username' => $username, 'offense' => $offense, 'ip' => $ip, 'browser' => $browser, 'url' => $url, 'request' => $request);
				Mail::send('emails.breach', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');

					$message->to("reagan.wilkins@gmail.com");

					$message->subject($data['username'] . " caused a security breach");

				});
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
				User::record();
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
				User::record();
				Session::flash('errorMessage', 'You are not authorized to respond to this message!');
				$breach = new Breach();
				$url = Request::url();
				$request = Request::method();
				$breach->url = $url;
				$breach->request = $request;
				$breach->user_id = Auth::id();
				$breach->ip_address = $_SERVER["REMOTE_ADDR"];
				$breach->browser = $_SERVER["HTTP_USER_AGENT"];
				$breach->email = Auth::user()->email;
				$breach->offense = "Attempted to respond to another user's message!";
				$breach->save();
				$email = Auth::user()->email;
				$username = Auth::user()->username;
				$offense = "Attempted to respond to another user's message!";
				$browser = $_SERVER["HTTP_USER_AGENT"];
				$ip = $_SERVER["REMOTE_ADDR"];
				$data = array('id' => $id, 'email' => $email, 'username' => $username, 'offense' => $offense, 'ip' => $ip, 'browser' => $browser, 'url' => $url, 'request' => $request);
				Mail::send('emails.breach', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');

					$message->to("reagan.wilkins@gmail.com");

					$message->subject($data['username'] . " caused a security breach");

				});
				return Redirect::back();
			}
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to respond to a message!');
			return Redirect::action('UsersController@showlogin');
		}
	}
	public function contactmember($id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
			$user = User::find($id);
			return View::make('messages.contactmember')->with('user', $user);
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to send a message!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function sendmessage($id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
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

	public function setupicebreaker($id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
			$icebreakers = Question::all();
			$user = User::find($id);
			return View::make('icebreakers.send')->with('user', $user)->with('icebreakers', $icebreakers);
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to send an icebreaker');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function sendicebreaker($id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
			$user = User::find($id);
			$ice = new Icebreaker();
			$ice->sender_id = Auth::id();
			$ice->receiver_id = $user->id;
			$ice->question1_id = Input::get('question1');
			$ice->question2_id = Input::get('question2');
			$ice->question3_id = Input::get('question3');
			$ice->save();
			$sender = Auth::user()->username;
			$receiver = $user->username;
			$email = $user->email;
			$data = array('receiver' => $receiver, 'sender' => $sender, 'email' => $email);
			Mail::send('emails.icebreaker', array('data' => $data), function($message) use ($data) {
				$message->from('reagan@screenlight.com', 'Screenlight Dating');

				$message->to($data['email']);

				$message->subject($data['sender'] . " sent you an icebreaker!");

			});
			Session::flash('successMessage', 'Nice! Your icebreaker has been sent!');
			return Redirect::action('UsersController@profile', $user->id);
		 } else {
			Session::flash('errorMessage', 'You must be logged in and verified in order to send an icebreaker!');
			return Redirect::action('UsersController@showlogin');
		 }
	}

	public function showicebreaker($id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
			$icebreaker = Icebreaker::find($id);
			$question1 = Question::find($icebreaker->question1_id);
			$question2 = Question::find($icebreaker->question2_id);
			$question3 = Question::find($icebreaker->question3_id);
			if(Auth::id() == $icebreaker->sender_id || Auth::id() == $icebreaker->receiver_id) {
				return View::make('icebreakers.show')->with('icebreaker', $icebreaker)->with('question1', $question1)->with('question2', $question2)->with('question3', $question3);
			} else {
				Session::flash('errorMessage', 'You are not authorized to view this!');
				//Security Breach
				return Redirect::back();
			}
		} else {
			Session::flash('errorMessage', 'You must be logged in to do this!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function replyicebreaker($id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
			$icebreaker = Icebreaker::find($id);
			if(Auth::id() == $icebreaker->receiver_id) {
				$icebreaker->question1_answer = Input::get('question1_answer');
				$icebreaker->question2_answer = Input::get('question2_answer');
				$icebreaker->question3_answer = Input::get('question3_answer');
				$icebreaker->save();
				$receiver = User::find($icebreaker->sender_id)->username;
				$sender = Auth::user()->username;
				$email = User::find($icebreaker->sender_id)->email;
				$data = array('receiver' => $receiver, 'sender' => $sender, 'email' => $email);
				Mail::send('emails.respondice', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');

					$message->to($data['email']);

					$message->subject($data['sender'] . " responded to your icebreaker!");

				});
				Session::flash('successMessage', 'Alright! Now its your turn! Send your own icebreaker!');
				return Redirect::action('MessageController@setupicebreaker', $icebreaker->sender_id);
			} else {
				Session::flash('errorMessage', 'You cannot respond to this icebreaker!');
				return Redirect::back();
			}
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to do this!');
			return Redirect::action('UsersController@showlogin');
		}
	}

}
?>