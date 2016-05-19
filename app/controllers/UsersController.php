<?php

class UsersController extends BaseController {

// Shows the sign up form
	public function showcreate() {

	// User cannot access the form if they are logged in
		if(!Auth::check()) {
			return View::make('users.create');
		
	// Redirects to the profile page and returns an error if the user is logged in
		} else {
			Session::flash('errorMessage', 'You already have a profile!');
			return Redirect::action('UsersController@profile', Auth::id());
		}
	}

// Stores the new user in the database
	public function store() {

	// User cannot send the form if they are logged in
		if(!Auth::check()) {
			$preference = " ";
			$validator = Validator::make(Input::all(), User::$rules);
		
		// User cannot submit the form if they are missing a field
			if($validator->fails()) {
				Session::flash('errorMessage', 'There was an error creating your profile');
				return Redirect::back()->withInput()->withErrors($validator);
			
		// If not logged in and all inputs are valid, stores the information in the database
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
				
			// Sends the new user a welcome email with their random verification code
				Mail::send('emails.welcome', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');

					$message->to($data['email']);

					$message->subject("Welcome to Screenlight Dating! Confirm your email!");

				});
				Session::flash('successMessage', 'Welcome!');
				return Redirect::action('UsersController@showlogin');
			}
		
	// Redirects to profile and returns an error if user is logged in.
		} else {
			Session::flash('errorMessage', 'You already have a profile!');
			return Redirect::action('UsersController@profile', Auth::id());
		}

	}

// Shows the verification form
	public function showverify() {

	// User can only be verified if they are logged in
		if(Auth::check()) {

		// User can only access the form if they are not already verified
			if(Auth::user()->check_if_verified() == false) {
				return View::make('users.verify');
			
		// If user is already verified, redirects them to their profile
			} else {
				return Redirect::action('UsersController@profile', Auth::id());
			}

	// Redirects to the login page and returns an error if user is not logged in
		} else {
			Session::flash('errorMessage', 'You need to be logged in to do this!');
			return Redirect::action('UsersController@showlogin');
		}
	}

// Checks the inputted verification code against the code stored in the database and verifies the user if it is correct
	public function doverify() {

	// User can only be verified if they are logged in
		if(Auth::check()) {

		// User can only submit the form if they are not already verified
			if(Auth::user()->check_if_verified() == false) {
				$code = Input::get('code');

			// If the inputted code is correct, verifies the user, redirects to the details page, and sends a confirmation email.
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
				
			// If inputted code is incorrect, reloads the page and returns an error
				} else {
					Session::flash('errorMessage', 'Your code is incorrect! Try again!');
					return Redirect::back();
				}
			}
		
	// Redirects to the login page and returns an error if the user is not logged in
		} else {
			Session::flash('errorMessage', 'You must be logged in to do this!');
			return Redirect::action('UsersController@showlogin');
		}
	}

// Shows the login page itself
	public function showlogin() {

	// User can only access the page if they are not already logged in
		if(!Auth::check()) {
			return View::make('users.login');
		
	// Redirects to the profile page and returns an error if the user is logged in already.
		} else {
			session::flash('errorMessage', 'You are already logged in!');
			return Redirect::action('UsersController@profile', Auth::id());
		}
	}

// Checks the inputted information against the database and attempts to login with it.
	public function dologin() {

	// User can only submit the form if they are not logged in
		if(!Auth::check()) {
			$data = [
				'email' => Input::get('email'),
				'password' => Input::get('password')
			];

		// If the information is correct, changes their status to online and logs them in.
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
				
			// If user is verified, redirects to profile upon login, otherwise, redirects to the verification page
				if(Auth::user()->check_if_verified() == true) {
					return Redirect::action('UsersController@profile', Auth::id());
				} else {
					return Redirect::action('UsersController@showverify');
				}

		// If information is incorrect, reloads the page and returns an error
			} else {
				Session::flash('errorMessage', 'Your email or password is incorrect. Please try again.');
				return Redirect::back();
			}

	// Redirects to the profile page and returns an error if the user is already logged in.
		} else {
			Session::flash('errorMessage', 'You are already logged in!');
			return Redirect::action('UsersController@profile', Auth::id());
		}
	}

// Logs the user out
	public function logout() {
		
	// User can only log out if they are already logged in
		if(Auth::check()) {
			$user = Auth::user();
			$user->online = "Offline";
			$user->save();
			Auth::logout();
			Session::flash('successMessage', 'Come back soon!');
			return Redirect::action('UsersController@showlogin');
		
	// Redirects to the homepage and returns an error if the user is not logged in
		} else {
			Session::flash('errorMessage', 'You are already logged out!');
			return Redirect::action('HomeController@homepage');
		}
	}

// Shows the details page
	public function showdetails() {
		
	// User can only access the page if they are logged in and verified
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			
		// User can only access the page if they have not already filled out their details
			if(Auth::user()->checkdetails(Auth::id()) == false) {
				$user = Auth::user();
				return View::make('users.details')->with('user', $user);
			
		// Redirects to the profile page and returns an error if the user has already filled out their details
			} else {
				Session::flash('errorMessage', 'You already filled out your details! If you want to edit your information, click on the "edit profile" button on your profile!');
				return Redirect::action('UsersController@profile', Auth::id());
			}

	// Redirects to the login page and returns an error if the user is not logged in.
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to do this!');
			return Redirect::action('UsersController@showlogin');
		}
	}

// Stores the details in the database
	public function dodetails() {
		
	// User can only submit the form if they are logged in and verified
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			
		// User can only submit the form if they have not already filled out their details
			if(Auth::user()->checkdetails(Auth::id()) == false) {
				$validator = Validator::make(Input::all(), User::$detailrules);
				
			// If fields are empty, reloads the page and return an error
				if($validator->fails()) {
					Session::flash('errorMessage', 'There was an error saving your data!');
					return Redirect::back()->withInput()->withErrors($validator);
				
			// If no errors, stores the details in the database
				} else {
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
					if($user->is_willing($user->id)) {
						$detail->can_host = Input::get('can_host');
					} else {
						$detail->can_host = "no";
					}
					$detail->availability_day = Input::get('availability_day');
					$detail->availability_time = Input::get('availability_time');
					$detail->other_features = Input::get('other_features');
					$detail->ideal = Input::get('ideal');
					$detail->save();
					Session::flash('successMessage', 'Your information has been saved!');
					return Redirect::action('UsersController@profile', Auth::id());
				}
			
		// Redirects to the profile page and returns an error if the user has already filled out their details
			} else {
				Session::flash('errorMessage', "You already filled in your details! If you want to edit your information, click the 'edit profile' button on your profile!");
				return Redirect::action('UsersController@profile', Auth::id());
			}
		
	// Redirects to the login page and returns an error if the user is not logged in or is not verified.
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to do this!');
			return Redirect::action('UsersController@showlogin');
		}
	}

// Shows the profile
	public function profile($id) {
		
	// User can only view profiles if they are logged in and verified (no voyeurs allowed on this site)
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			$user = User::find($id);
			$percent = User::percent_match($user->id);
			$images = DB::table('images')->where('user_id', $id)->get();
			return View::make('users.profile')->with('user', $user)->with('images', $images)->with('percent', $percent);
	// Redirects to the login page and returns an error if the user is not logged in or is not verified
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to view profiles!');
			return Redirect::action('UsersController@showlogin');
		}
	}

// Shows the profile edit page
	public function showedit($id) {

	// User must be logged in and verified
		if(Auth::check() && Auth::user()->check_if_verified() == true) {

		// The user's id must match the id of the user they are trying to edit
			if(Auth::id() == $id) {

			// User must have already filled in their details
				if(Auth::user()->checkdetails(Auth::id()) == true) {
					$user = User::find($id);
					$details = DB::table('details')->where('user_id', Auth::id())->get();
					return View::make('users.edit')->with('user', $user)->with('details', $details);
				
			// Redirects to the details page if the user has not filled in their details yet
				} else {
					Session::flash('errorMessage', "You haven't even filled out these details yet! Once you complete this form, you can edit it to your heart's content!");
					return Redirect::action('UsersController@showdetails');
				}
			
			// Redirects to the previous page and alerts me of a security breach if the user's id does not match the id they are trying to edit
			} else {
				Session::flash('errorMessage', "You are not authorized to edit this user's information!");
				$breach = new Breach();
				$breach->user_id = Auth::id();
				$breach->email = Auth::user()->email;
				$breach->offense = "Tried to access the edit page unathorized";
				$browser = $_SERVER["HTTP_USER_AGENT"];
				$ip = $_SERVER["REMOTE_ADDR"];
				$data = array('id' => $id, 'email' => $email, 'username' => $username, 'offense' => $offense, 'ip' => $ip, 'browser' => $browser);
				$breach->save();
				return Redirect::back();
			}
		
	// Redirects to the login page and returns an error if the user is not logged in
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to edit your profile!');
			return Redirect::action('UsersController@showlogin');
		}
	}

// Stores the updated data in the database
	public function doedit($id) {

	// User must be logged in and verified to submit the form
		if(Auth::check() && Auth::user()->check_if_verified() == true) {

		// User's id must match the id of the user they are trying to edit
			if(Auth::id() == $id) {

			// User can only submit the form if they already filled out their details
				if(Auth::user()->checkdetails(Auth::id()) == true) {
					$validator = Validator::make(Input::all(), User::$editrules);
					
				// If any fields are left unfilled or repeated, returns an error and reloads the page. Otherwise, stores the new data
					if($validator->fails()) {
						Session::flash('errorMessage', 'There was an error editing your details!');
						return Redirect::back()->withInput()->withErrors($validator);
					} else {
						$user = User::find($id);
						$checkdbforusername = DB::table('users')->where('username', Input::get('username'))->get();
						$checkdbforemail = DB::table('users')->where('email', Input::get('email'))->get();
						$details = DB::table('details')->where('user_id', Auth::id())->get();
						
					// Checks the email field. If it is the same email as before, it is fine. If it is a different, unique email, it is fine. If not, returns an error and reloads the page.
						if($checkdbforemail != null) {
							foreach($checkdbforemail as $entry) {
								if($entry->id != $user->id) {
									Session::flash('errorMessage', 'This email is already in use');
									return Redirect::back()->withInput();
								}
							}
						}

					// Runs through the same process for username
						if($checkdbforusername != null) {
							foreach($checkdbforusername as $entry) {
								if($entry->id != $user->id) {
									Session::flash('errorMessage', 'This username is alredy in use');
									return Redirect::back()->withInput();
								}
							}
						}
						$user->username = Input::get('username');
						$user->email = Input::get('email');
						$user->preference = Input::get('preference');
						$user->state = Input::get('state');
						$user->city = Input::get('city');
						$user->zipcode = Input::get('zipcode');
						$user->willing = Input::get('willing');
						$user->save();
						foreach($details as $detail) {
							$edetail = Detail::find($detail->id);
							$edetail->introduction = Input::get('introduction');
							$edetail->about_me = Input::get('about');
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
							if($user->is_willing($user->id)) {
								$edetail->can_host = Input::get('can_host');
							} else {
								$edetail->can_host = "no";
							}
							$edetail->availability_day = Input::get('availability_day');
							$edetail->availability_time = Input::get('availability_time');
							$edetail->other_features = Input::get('other_features');
							$edetail->ideal = Input::get('ideal');
							$edetail->save();
						}
						Session::flash('successMessage', 'You have successfully edited your profile!');
						return Redirect::action('UsersController@profile', $user->id);
					}

			// If user hasn't already filled in their details, redirects to the details page and returns an error
				} else {
					Session::flash('errorMessage', "You haven't even filled out these details yet! Onnce you complete this form, you can edit it to your heart's content!");
					return Redirect::action('UsersController@showdetails');
				}

		// If user's id is not correct, returns an error and alerts me to a security breach, since they couldn't have submitted the form without hacking.
			} else {
				Session::flash('errorMessage', "You are not authorized to edit this page, and you couldn't be sending a POST request from this page without using malicious code. Your data has been logged, hacker!");
				$breach = new Breach();
				$breach->user_id = Auth::id();
				$breach->ip_address = $_SERVER["REMOTE_ADDR"];
				$breach->browser = $_SERVER["HTTP_USER_AGENT"];
				$breach->email = Auth::user()->email;
				$breach->offense = "Accessed the edit function directly unauthorized";
				$breach->save();
				$email = Auth::user()->email;
				$username = Auth::user()->username;
				$offense = "Accessed the edit function directly unauthorized";
				$browser = $_SERVER["HTTP_USER_AGENT"];
				$ip = $_SERVER["REMOTE_ADDR"];
				$data = array('id' => $id, 'email' => $email, 'username' => $username, 'offense' => $offense, 'ip' => $ip, 'browser' => $browser);
				Mail::send('emails.breach', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');

					$message->to("reagan.wilkins@gmail.com");

					$message->subject($data['username'] . " caused a security breach");

				});
				return Redirect::action('HomeController@homepage');
			}

	// If user is not logged in and verified, redirects to the login page and returns an error
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified in order to do this!');
			return Redirect::action('UsersController@showlogin');
		}
	}

// Shows the image upload form
	public function showimages($id) {

	// User must be logged in and verified
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			
		// User id must match the id they are trying to reach
			if(Auth::id() == $id) {
				$user = Auth::user();
				$images = DB::table('images')->where('user_id', $id)->get();
				// dd($images[]);
				return View::make('users.images')->with('user', $user)->with('images', $images);
			
		// If id doesn't match, returns an error and notifies me of a security breach
			} else {
				Session::flash('errorMessage', 'You are not authorized to view this page');
				$breach = new Breach();
				$breach->user_id = Auth::id();
				$breach->email = Auth::user()->email;
				$breach->ip_address = $_SERVER["REMOTE_ADDR"];
				$breach->browser = $_SERVER["HTTP_USER_AGENT"];
				$breach->offense = "Tried to access the image upload form unauthorized.";
				$breach->save();
				return Redirect::back();
			}

	// If user is not logged in and verified, returns an error and redirects to the login page
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to upload an image!');
			return Redirect::action('UsersController@showlogin');
		}
	}

// Stores the uploaded image in the database
	public function storeimage($id) {

	// User must be logged in and verified
		if(Auth::checK() && Auth::user()->check_if_verified() == true) {
			
		// User id must match the id they are trying to reach
			if(Auth::id() == $id) {
				$user = User::find($id);
				$images = DB::table('images')->where('user_id', $id)->get();
				if(Input::file('image') != null) {
					$imagename = Input::file('image');
					$originalname = $imagename->getClientOriginalName();
					$imagepath = 'public/img/uploads/';
					$imagename->move($imagepath, $originalname);
					
				// If the user doesn't have any images uploaded and doesn't have a profile picture, sets the uploaded image as the profile picture. Otherwise, places the image in the image table.
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
				
			// Returns an error if there isn't an image selected
				} else {
					Session::flash('errorMessage', 'There was an error uploading your image!');
					return Redirect::back();
				}
			
		// If user id doesn't match, returns an error and notifies me of a security breach.
			} else {
				Session::flash('errorMessage', 'You are not authorized to upload an image for this user, and you could not have sent a POST request from this page unless you were using malicious code. Your information has been logged, hacker!');
				$breach = new Breach();
				$breach->user_id = Auth::id();
				$breach->email = Auth::user()->email;
				$breach->offense = "Accessed the image upload function directly unauthorized";
				$breach->ip_address = $_SERVER["REMOTE_ADDR"];
				$breach->browser = $_SERVER["HTTP_USER_AGENT"];
				$breach->save();
				$email = Auth::user()->email;
				$username = Auth::user()->username;
				$offense = "Accessed the image upload function directly unauthorized";
				$browser = $_SERVER["HTTP_USER_AGENT"];
				$ip = $_SERVER["REMOTE_ADDR"];
				$data = array('id' => $id, 'email' => $email, 'username' => $username, 'offense' => $offense, 'ip' => $ip, 'browser' => $browser);
				Mail::send('emails.breach', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');

					$message->to("reagan.wilkins@gmail.com");

					$message->subject($data['username'] . " caused a security breach");

				});
				return Redirect::action('HomeController@homepage');

			}

	// If not logged in and verified, redirects to the login page and returns an error
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to upload an image!');
			return Redirect::action('UsersController@showlogin');
		}
	}

// Shows the form to edit the password
	public function editpassword($id) {

	// User must be logged in and verified
		if(Auth::check() && Auth::user()->check_if_verified() == true) {

		// User id must be correct
			if(Auth::id() == $id) {
				$user = Auth::user();
				return View::make('users.editpassword')->with('user', $user);
			
		// If User id doesn't match, notifies me of a security breach and returns an error. Trying to edit somebody's password is a big deal.
			} else {
				$breach = new Breach();
				$breach->user_id = Auth::id();
				$breach->email = Auth::user()->email;
				$breach->offense = "Attempted to access another user's edit password page";
				$breach->ip_address = $_SERVER["REMOTE_ADDR"];
				$breach->browser = $_SERVER["HTTP_USER_AGENT"];
				$breach->save();
				$email = Auth::user()->email;
				$username = Auth::user()->username;
				$offense = "Attempted to access another user's edit password page";
				$browser = $_SERVER["HTTP_USER_AGENT"];
				$ip = $_SERVER["REMOTE_ADDR"];
				$data = array('id' => $id, 'email' => $email, 'username' => $username, 'offense' => $offense, 'ip' => $ip, 'browser' => $browser);
				Mail::send('emails.breach', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');

					$message->to("reagan.wilkins@gmail.com");

					$message->subject($data['username'] . " caused a security breach");

				});
				Session::flash('errorMessage', "You are not authorized to update this user's password. If you reached this page in error, please be more careful next time. If the problem persists, please feel free to contact us.");
				return Redirect::action('HomeController@homepage');
			}

	// If user is not logged in and verified, returns an error and redirects to the login page
		} else {
			Session::flash('errorMessage', 'You must be logged in and verified to edit your password');
			return Redirect::action('UsersController@showlogin');
		}
	}

// Stores the updated password in the database
	public function updatepassword($id) {

	// User must be logged in and verified
		if(Auth::check() && Auth::user()->check_if_verified() == true) {

		// User id must be correct
			if(Auth::id() == $id) {
				$validator = Validator::make(Input::all(), User::$passwordrules);
				if($validator->fails()) {
					Session::flash('errorMessage', 'There was a problem changing your password');
					return Redirect::back()->withErrors($validator);
				} else {
					$user = Auth::user();
					if(password_verify(Input::get('current_password'), $user->password)) {
						$user->password = Hash::make(Input::get('new_password'));
						$user->save();
						Session::flash('successMessage', 'You have successfully updated your password!');
						return Redirect::action('UsersController@profile', Auth::id());
					} else {
						Session::flash('errorMessage', 'The password you entered is incorrect. Please try again!');
						return Redirect::back();
					}
				}

		// If User id doesn't match and a POST request is sent from here, it is a hacking attempt, and I am notified, and an error is returned. 
			} else {
				$breach = new Breach();
				$breach->user_id = Auth::id();
				$breach->email = Auth::user()->email;
				$breach->offense = "Sent a direct post request on the password update form while unauthorized";
				$breach->ip_address = $_SERVER["REMOTE_ADDR"];
				$breach->browser = $_SERVER["HTTP_USER_AGENT"];
				$breach->save();
				$email = Auth::user()->email;
				$username = Auth::user()->username;
				$offense = "Sent a direct post request on the password update form while unauthorized";
				$browser = $_SERVER["HTTP_USER_AGENT"];
				$ip = $_SERVER["REMOTE_ADDR"];
				$data = array('id' => $id, 'email' => $email, 'username' => $username, 'offense' => $offense, 'ip' => $ip, 'browser' => $browser);
				Mail::send('emails.breach', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');

					$message->to("reagan.wilkins@gmail.com");

					$message->subject($data['username'] . " caused a security breach");

				});
				Session::flash('errorMessage', "You are not authorized to update this user's password, and you couldn't possibly be sending a POST request from this page without using malicious code. Your information has been logged, Hacker!");
				return Redirect::action('HomeController@homepage');
			}

	// If user is not logged in and verified, returns an error and redirects to the login page
		} else {
			Session::flash('errorMessage', 'You must be logged in to update your password!');
			return Redirect::action('UsersController@showlogin');
		}
	}

// Removes all traces of the user from the database
	public function destroy($id) {

	// User must be logged in and verified
		if(Auth::check() && Auth::user()->check_if_verified() == true) {
			
		// User id must be correct
			if(Auth::id() == $id) {
				$user = User::find($id);

			// User must give the correct password
				if(password_verify(Input::get('password'), $user->password)) {
					$allmatches = Match::all();
					$userdetails = DB::table('details')->where('user_id', $user->id);
					$allimages = Image::all();
					$allmessages = Message::all();
					$allreplies = Reply::all();
					$allbreaches = Breach::all();
					$allvotes = Vote::all();
					$allvisits = Visit::all();
					$matchids = [];
					$imageids = [];
					$messageids = [];
					$replyids = [];
					$breachids = [];
					$voteids = [];
					$visitids = [];

				// Deletes all the user's matches from the database
					foreach($allmatches as $match) {
						if($match->person1_id == $user->id) {
							array_push($matchids, $match->id);
						} else if($match->person2_id == $user->id) {
							array_push($matchids, $match->id);
						}
					}

					foreach($matchids as $matchid) {
						$matchtodelete = DB::table('matches')->where('id', $matchid);
						$matchtodelete->delete();
					}

				// Deletes all the user's images from the database
					foreach($allimages as $image) {
						if($image->user_id == $user->id) {
							array_push($imageids, $image->id);
						}
					}

					foreach($imageids as $imageid) {
						$imagetodelete = DB::table('images')->where('id', $imageid);
						$imagetodelete->delete();
					}

				// Deletes all the user's responses from the database
					foreach($allreplies as $reply) {
						if($reply->responder_id == $user->id) {
							array_push($replyids, $reply->id);
						} else if($reply->receiver_id == $user->id) {
							array_push($replyids, $reply->id);
						}
					}

					foreach($replyids as $replyid) {
						$replytodelete = DB::table('replies')->where('id', $replyid);
						$replytodelete->delete();
					}

				// Deletes all the user's messages from the database
					foreach($allmessages as $message) {
						if($message->sender_id == $user->id) {
							array_push($messageids, $message->id);
						} else if($message->receiver_id == $user->id) {
							array_push($messageids, $message->id);
						}
					}

					foreach($messageids as $messageid) {
						$messagetodelete = DB::table('messages')->where('id', $messageid);
						$messagetodelete->delete();
					}

				// Deletes all the user's votes from the database
					foreach($allvotes as $vote) {
						if($vote->subject_id == $user->id) {
							array_push($voteids, $vote->id);
						} else if($vote->voter_id == $user->id) {
							array_push($voteids, $vote->id);
						}
					}

					foreach($voteids as $voteid) {
						$votetodelete = DB::table('votes')->where('id', $voteid);
						$votetodelete->delete();
					}

				// Deletes all the user's votes from the database
					foreach($allvisits as $visit) {
						if($visit->user_id == $user->id) {
							array_push($visitids, $visit->id);
						} 
					}

					foreach($visitids as $visitid) {
						$visittodelete = DB::table('visits')->where('id', $visitid);
						$visittodelete->delete();
					}

				// Deletes all the user's security breaches from the database (however, I still have all of the data via email)
					foreach($allbreaches as $breach) {
						if($breach->user_id == $user->id) {
							array_push($breachids, $breach->id);
						}
					}

					foreach($breachids as $breachid) {
						$breachtodelete = DB::table('breaches')->where('id', $breachid);
						$breachtodelete->delete();
					}

					$userdetails->delete();

					Session::flash('successMessage', "We're sorry to see you go!");
					return Redirect::action('HomeController@homepage');

			// If password is incorrect, returns an error and reloads the page
				} else {
					Session::flash('errorMessage', "Your password is incorrect.");
					return Redirect::back();
				}

		// If user id is incorrect, it is a very serious hacking attempt. Notifies me of a security breach and returns an error
			} else {
				$breach = new Breach();
				$breach->user_id = Auth::id();
				$breach->email = Auth::user()->email;
				$breach->offense = "Sent a direct delete request from an unauthorized page";
				$breach->ip_address = $_SERVER["REMOTE_ADDR"];
				$breach->browser = $_SERVER["HTTP_USER_AGENT"];
				$breach->save();
				$email = Auth::user()->email;
				$username = Auth::user()->username;
				$offense = "Sent a direct delete request from an unauthorized page";
				$browser = $_SERVER["HTTP_USER_AGENT"];
				$ip = $_SERVER["REMOTE_ADDR"];
				$data = array('id' => $id, 'email' => $email, 'username' => $username, 'offense' => $offense, 'ip' => $ip, 'browser' => $browser);
				Mail::send('emails.breach', array('data' => $data), function($message) use ($data) {
					$message->from('reagan@screenlight.com', 'Screenlight Dating');

					$message->to("reagan.wilkins@gmail.com");

					$message->subject($data['username'] . " caused a security breach");

				});
				Session::flash('errorMessage', "You are in very big trouble. Trying to delete a user's account that isn't your own? Nice try. Your information has been logged, hacker!");
				return Redirect::action('HomeController@homepage');
			}

	// If user is not logged in and verified, returns an error and redirects to the login page
		} else {
			Session::flash('errorMessage', "You must be logged in to do this!");
			return Redirect::action('UsersController@showlogin');
		}
	}
}
?>