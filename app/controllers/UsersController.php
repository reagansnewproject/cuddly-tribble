<?php

class UsersController extends BaseController {

	public function showcreate() {
		if(!Auth::check()) {
			return View::make('users.create');
		} else {
			Session::flash('errorMessage', 'You already have a profile!');
			return Redirect::action('UsersController@profile', Auth::id());
		}
	}

	public function store() {
		if(!Auth::check()) {
			$preference = " ";
			$validator = Validator::make(Input::all(), User::$rules);
			if($validator->fails()) {
				Session::flash('errorMessage', 'There was an error creating your profile');
				return Redirect::back()->withInput()->withErrors($validator);
			} else {
				$user = new User();
				$user->username = Input::get('username');
				$user->email = Input::get('email');
				$user->gender = Input::get('gender');
				$user->ethnicity = Input::get('ethnicity');
				$user->preference = Input::get('preference');
				$user->birthday = Input::get('day') . " " . Input::get('month') . ", " . Input::get('year');
				$user->state = Input::get('state');
				$user->city = Input::get('city');
				$user->zipcode = Input::get('zipcode');
				$user->willing = Input::get('willing');
				$user->password = Hash::make(Input::get('password'));
				$user->is_verified = "No";
				$random = floor(rand(1, 10000));
				$user->code = $random;
				$user->image_url = "/img/noimage.png";
				$user->online = "Offline";
				$user->save();
				$username = $user->username;
				$email = $user->email;
				$data = array('email' => $email, 'username' => $username, 'random' => $random);
				Mail::send('emails.welcome', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');

					$message->to($data['email']);

					$message->subject("Welcome to Screenlight Dating! Confirm your email!");

				});
				Session::flash('successMessage', 'Welcome!');
				return Redirect::action('UsersController@showlogin');
			}
		} else {
			Session::flash('errorMessage', 'You already have a profile!');
			return Redirect::action('UsersController@profile', Auth::id());
		}

	}

	public function showverify() {
		if(Auth::check()) {
			if(Auth::user()->check_if_verified() == false) {
				return View::make('users.verify');
			} else {
				return Redirect::action('UsersController@profile', Auth::id());
			}
		} else {
			Session::flash('errorMessage', 'You need to be logged in to do this!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function doverify() {
		if(Auth::check()) {
			if(Auth::user()->check_if_verified() == false) {
				$code = Input::get('code');
				if($code == Auth::user()->code) {
					$user = User::find(Auth::id());
					$user->is_verified = "Yes";
					$user->save();
					$id = $user->id;
					$email = $user->email;
					$username = $user->username;
					$data = array('id' => $id, 'email' => $email, 'username' => $username);
					Mail::send('emails.verified', array('data' => $data), function($message) use ($data) {
						$message->from('reagan@screenlight.com', 'Screenlight Dating');

						$message->to($data['email']);

						$message->subject("Account Verification Complete!");

					});
					Session::flash('successMessage', 'You have been successfully verified');
					return Redirect::action('UsersController@showdetails');
				} else {
					Session::flash('errorMessage', 'Your code is incorrect! Try again!');
					return Redirect::back();
				}
			}
		} else {
			Session::flash('errorMessage', 'You must be logged in to do this!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function showlogin() {
		if(!Auth::check()) {
			return View::make('users.login');
		} else {
			session::flash('errorMessage', 'You are already logged in!');
			return Redirect::action('UsersController@profile', Auth::id());
		}
	}

	public function dologin() {
		if(!Auth::check()) {
			$data = [
				'email' => Input::get('email'),
				'password' => Input::get('password')
			];

			if(Auth::attempt($data)) {
				Session::flash('successMessage', 'Hello!');
				$visit = new Visit();
				$visit->user_id = Auth::user()->id;
				$visit->ip_address = $_SERVER["REMOTE_ADDR"];
				$visit->browser = $_SERVER["HTTP_USER_AGENT"];
				$visit->save();
				$user = Auth::user();
				$user->online = "Online";
				$user->save();
				if(Auth::user()->check_if_verified() == true) {
					return Redirect::action('UsersController@profile', Auth::id());
				} else {
					return Redirect::action('UsersController@showverify');
				}
			} else {
				Session::flash('errorMessage', 'Your email or password is incorrect. Please try again.');
				return Redirect::back();
			}
		} else {
			Session::flash('errorMessage', 'You are already logged in!');
			return Redirect::action('UsersController@profile', Auth::id());
		}
	}
	public function logout() {
		if(Auth::check()) {
			$user = Auth::user();
			$user->online = "Offline";
			$user->save();
			Auth::logout();
			Session::flash('successMessage', 'Come back soon!');
			return Redirect::action('UsersController@showlogin');
		} else {
			Session::flash('errorMessage', 'You are already logged out!');
			return Redirect::action('HomeController@homepage');
		}
	}

	public function showdetails() {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			$user = Auth::user();
			return View::make('users.details')->with('user', $user);
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to do this!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function dodetails() {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			$user = Auth::user();
			$detail = new Detail();
			$detail->user_id = $user->id;
			$detail->introduction = Input::get('introduction');
			$detail->about_me = Input::get('about');
			$detail->personality = Input::get('personality');
			$detail->marital_status = Input::get('marital_status');
			$detail->children = Input::get('children');
			$detail->want_children = Input::get('want_children');
			$detail->religion = Input::get('religion');
			$detail->job = Input::get('job');
			$detail->income = Input::get('income');
			$detail->hair_color = Input::get('hair_color');
			$detail->hair_length = Input::get('hair_length');
			$detail->eye_color = Input::get('eye_color');
			$detail->body_type = Input::get('body_type');
			$detail->height = Input::get('height');
			$detail->weight = Input::get('weight');
			$detail->can_host = Input::get('can_host');
			$detail->availability_day = Input::get('availability_day');
			$detail->availability_time = Input::get('availability_time');
			$detail->other_features = Input::get('other_features');
			$detail->ideal = Input::get('ideal');
			$detail->save();
			Session::flash('successMessage', 'Your information has been saved!');
			return Redirect::action('HomeController@homepage');
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to do this!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function profile($id) {
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			$user = User::find($id);
			$images = DB::table('images')->where('user_id', $id)->get();
			return View::make('users.profile')->with('user', $user)->with('images', $images);
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to view profiles!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function showedit($id) {
		if(Auth::id() == $id) {
			$user = User::find($id);
			$details = DB::table('details')->where('user_id', Auth::id());
			return View::make('users.edit')->with('user', $user)->with('details', $details);
		} else {
			Session::flash('errorMessage', 'You are not authorized to edit this user\'s information!');
			$breach = new Breach();
			$breach->user_id = Auth::id();
			$breach->email = Auth::user()->email;
			$breach->offense = "Tried to access the edit page unathorized";
			$breach->save();
			return Redirect::back();
		}
	}

	public function doedit($id) {
		if(Auth::id() == $id) {
			$user = User::find($id);
			$details = DB::table('details')->where('user_id', Auth::id());
			$user->preference = Input::get('preference');
			$user->state = Input::get('state');
			$user->city = Input::get('city');
			$user->zipcode = Input::get('zipcode');
			$user->willing = Input::get('willing');
			$user->save();
			foreach($details as $detail) {
				$edetail = Detail::find($detail->id);
				$edetail->introduction = Input::get('introduction');
				$edetail->about = Input::get('about');
				$edetail->personality = Input::get('personality');
				$edetail->marital_status = Input::get('marital_status');
				$edetail->children = Input::get('children');
				$edetail->want_children = Input::get('want_children');
				$edetail->religion = Input::get('religion');
				$edetail->job = Input::get('job');
				$edetail->income = Input::get('income');
				$edetail->hair_color = Input::get('hair_color');
				$edetail->hair_length = Input::get('hair_length');
				$edetail->eye_color = Input::get('eye_color');
				$edetail->body_type = Input::get('body_type');
				$edetail->height = Input::get('height');
				$edetail->weight = Input::get('weight');
				$edetail->can_host = Input::get('can_host');
				$edetail->availability_day = Input::get('availability_day');
				$edetail->availability_time = Input::get('availability_time');
				$edetail->other_features = Input::get('other_features');
				$edetail->ideal = Input::get('ideal');
				$edetail->save();
			}
			Session::flash('successMessage', 'You have successfully edited your profile!');
			return Redirect::action('UsersController@profile', $user->id);
		} else {
			Session::flash('errorMessage', 'You are not authorized to edit this page. Your data has been logged, hacker!');
			$breach = new Breach();
			$breach->user_id = Auth::id();
			$breach->email = Auth::user()->email;
			$breach->offense = "Accessed the edit function directly unauthorized";
			$breach->save();
			$email = Auth::user()->email;
			$username = Auth::user()->username;
			$offense = "Accessed the edit function directly unauthorized";
			$data = array('id' => $id, 'email' => $email, 'username' => $username, 'offense' => $offense);
			Mail::send('emails.breach', array('data' => $data), function($message) use ($data) {
				$message->from('reagan@screenlight.com', 'Screenlight Dating');

				$message->to("reagan.wilkins@gmail.com");

				$message->subject($data['username'] . " caused a security breach");

			});
}
	}

	public function showimages($id) {
		if(Auth::check()) {
			if(Auth::id() == $id) {
				$user = Auth::user();
				$images = DB::table('images')->where('user_id', $id)->get();
				// dd($images[]);
				return View::make('users.images')->with('user', $user)->with('images', $images);
			} else {
				Session::flash('errorMessage', 'You are not authorized to view this page');
				$breach = new Breach();
				$breach->user_id = Auth::id();
				$breach->email = Auth::user()->email;
				$breach->offense = "Tried to access the image upload form unauthorized.";
				$breach->save();
				return Redirect::back();
			}
		} else {
			Session::flash('errorMessage', 'You must be logged in to upload an image!');
			return Redirect::action('UsersController@showlogin');
		}
	}

	public function storeimage($id) {
		if(Auth::checK()) {
			if(Auth::id() == $id) {
				$user = User::find($id);
				$images = DB::table('images')->where('user_id', $id)->get();
				if(Input::file('image') != null) {
					$imagename = Input::file('image');
					$originalname = $imagename->getClientOriginalName();
					$imagepath = 'public/img/uploads/';
					$imagename->move($imagepath, $originalname);
					if($images == null && $user->image_url == "/img/noimage.png") {
						$user->image_url = $imagepath . $originalname;
						$user->save();
					} else {
						$image = new Image();
						$image->url = $imagepath . $originalname;
						$image->user_id = $user->id;
						$image->save();
					}
					Session::flash('successMessage', 'You have successfully uploaded a photo!');
					return Redirect::action('UsersController@storeimage', $user->id);
				} else {
					Session::flash('errorMessage', 'There was an error uploading your image!');
					return Redirect::back();
				}
			} else {
				Session::flash('errorMessage', 'You are not authorized to upload an image for this user. Your information has been logged, hacker!');
				$breach = new Breach();
				$breach->user_id = Auth::id();
				$breach->email = Auth::user()->email;
				$breach->offense = "Accessed the image upload function directly unauthorized";
				$breach->save();
				$email = Auth::user()->email;
				$username = Auth::user()->username;
				$offense = "Accessed the image upload function directly unauthorized";
				$data = array('id' => $id, 'email' => $email, 'username' => $username, 'offense' => $offense);
				Mail::send('emails.breach', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');

					$message->to("reagan.wilkins@gmail.com");

					$message->subject($data['username'] . " caused a security breach");

				});

			}
		} else {
			Session::flash('errorMessage', 'You must be logged in to upload an image!');
			return Redirect::action('UsersController@showlogin');
		}
	}
}
?>