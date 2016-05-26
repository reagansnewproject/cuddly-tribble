<?php
class BrowseController extends BaseController {

	public function index() {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
			$matches = Auth::user()->allmatches();
			// $matches = DB::table('users')->where('willing', Auth::user()->willing)->where('gender', Auth::user()->preference);
			return View::make('browse.index')->with('matches', $matches);
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to view members!');
			return Redirect::action('UsersController@showlogin');
		}
	}
	public function closest() {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
			$matches = DB::table('users')->where('willing', Auth::user()->willing)->where('gender', Auth::user()->preference)->where('city', Auth::user()->city)->where('state', Auth::user()->state)->get();
			return View::make('browse.closest')->with('matches', $matches);
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to view members!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function determinevote() {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
			$user = Auth::user();
			$matches = $user->unvotedmatches();
			$random = floor(rand(0, (count($matches)-1)));
			if($matches != null) {
				return Redirect::action('BrowseController@showvote', $matches[$random]->id);
			} else {
				Session::flash('errorMessage', 'There are no more matches to vote on right now! Check back again later!');
				return Redirect::action('BrowseController@index');
			}
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to vote!');
			return Redirect::action('UsersController@showlogin');
		}

	}

	public function showvote($id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
			$user = Auth::user();
			$match = User::find($id);
			// $image = DB::table('images')->where('user_id', $match->id)->where('is_main', 'Yes')->get();
			return View::make('browse.showvote')->with('user', $user)->with('match', $match);
		} else {
			Session::flash('errorMessage', 'You must be loggin in and verified to vote!');
			return Redirect::action('UsersController@showlogin');
		}
		
	}

	public function storevote($id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			User::record();
			$user = Auth::user();
			$match = User::find($id);
			$vote = new Vote();
			$vote->subject_id = $match->id;
			$vote->voter_id = $user->id;
			$vote->vote = Input::get('vote');
			$vote->save();
			$othervotes = DB::table('votes')->where('subject_id', $user->id)->where('voter_id', $match->id)->get();
			if($othervotes != null) {
				foreach($othervotes as $othervote) {

					if($othervote->vote == Input::get('vote')) {
						$newmatch = new Match();
						$newmatch->person1_id = $user->id;
						$newmatch->person2_id = $match->id;
						$newmatch->save();
						$getter = User::find($match->id);
						$sender = User::find(Auth::id());
						$receiver_email = $getter->email;
						$receiver_username = $getter->username;
						$sender_username = $sender->username;
						$data = array('receiver_email' => $receiver_email, 'receiver_username' => $receiver_username, 'sender_username' => $sender_username);
						Mail::send('emails.match', array('data' => $data), function($message) use ($data) {
							$message->from('reagan@screenlight.com', 'Screenlight Dating');

							$message->to($data['receiver_email']);

							$message->subject("You matched with " . $data['sender_username']);

						});
						$getter = User::find(Auth::id());
						$sender = User::find($match->id);
						$receiver_email = $getter->email;
						$receiver_username = $getter->username;
						$sender_username = $sender->username;
						$data = array('receiver_email' => $receiver_email, 'receiver_username' => $receiver_username, 'sender_username' => $sender_username);
						Mail::send('emails.match', array('data' => $data), function($message) use ($data) {
							$message->from('reagan@screenlight.com', 'Screenlight Dating');

							$message->to($data['receiver_email']);

							$message->subject("You matched with " . $data['sender_username']);

						});

					}
				}
			}
			Session::flash('successMessage', 'Gotcha! Storing your vote!');
			return Redirect::action('BrowseController@determinevote');
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified in order to vote!');
			return Redirect::action('UsersController@showlogin');
		}
	}
}
?>