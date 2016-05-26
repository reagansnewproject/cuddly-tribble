<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

// Rules to be used upon creation of a new user
	public static $rules = array(
		'username' => 'required|unique:users',
		'email' => 'required|email|unique:users',
		'gender' => 'required',
		'ethnicity' => 'required',
		'preference' => 'required',
		'day' => 'required',
		'month' => 'required',
		'year' => 'required',
		'state' => 'required',
		'city' => 'required',
		'zipcode' => 'required',
		'willing' => 'required',
		'password' => 'required|confirmed',
		'contract' => 'required',
	);

// Rules to be used as a user fills in their details
	public static $detailrules = array(
		'introduction' => 'required',
		'about' => 'required',
		'personality' => 'required',
		'marital_status' => 'required',
		'children' => 'required',
		'want_children' => 'required',
		'religion' => 'required',
		'politics' => 'required',
		'job' => 'required',
		'income' => 'required',
		'hair_color' => 'required',
		'hair_length' => 'required',
		'eye_color' => 'required',
		'body_type' => 'required',
		'height' => 'required',
		'weight' => 'required',
		'availability_day' => 'required',
		'availability_time' => 'required',
		'other_features' => 'required',
		'ideal' => 'required',
	);

// Rules to be used when a user edits their information
	public static $editrules = array(
		'username' => 'required',
		'email' => 'required|email',
		'preference' => 'required',
		'state' => 'required',
		'city' => 'required',
		'zipcode' => 'required',
		'willing' => 'required',
		'introduction' => 'required',
		'about' => 'required',
		'personality' => 'required',
		'marital_status' => 'required',
		'children' => 'required',
		'want_children' => 'required',
		'religion' => 'required',
		'politics' => 'required',
		'job' => 'required',
		'income' => 'required',
		'hair_color' => 'required',
		'hair_length' => 'required',
		'eye_color' => 'required',
		'body_type' => 'required',
		'height' => 'required',
		'weight' => 'required',
		'availability_day' => 'required',
		'availability_time' => 'required',
		'other_features' => 'required',
		'ideal' => 'required',
	);

// Rules to be used when the user edits their password
	public static $passwordrules = array(
		'new_password'=> 'required|confirmed',
	);

// Checks the database to see if the user has already filled in their details. If they've filled them in, returns true. If not, returns false.
	public function checkdetails($id) {
		$details = DB::table('details')->where('user_id', $id)->get();
		if($details != null) {
			return true;
		} else {
			return false;
		}
	}

	public function activities() {
		$this->hasMany('Activity');
	}

	public function breaches() {
		$this->hasManyy('Breach');
	}
	public function visits() {
		$this->hasMany('Visit');
	}

	public function images() {
		$this->hasMany('Image');
	}

	public function messages() {
		$this->hasMany('Message');
	}

	public function detail() {
		$this->belongsTo('Detail');
	}

// Checks to see if the user checked "yes" or "no" on the "willing" field.
	public static function is_willing($id) {
		$user = User::find($id);
		if($user->willing == "Yes") {
			return true;
		} else {
			return false;
		}
	}

// Checks to see if the user is verified
	public static function check_if_verified() {
		$user = Auth::user();
		if($user->is_verified == "Yes") {
			return true;
		} else {
			return false;
		}
	}

// Creates a record of the user's activity upon each page load.
	public static function record() {
		$user = Auth::user();
		$record = new Activity();
		$record->user_id = $user->id;
		$record->url = Request::url();
		$record->request = Request::method();
		$record->save();
	}

// Checks the amount of messages and replies in the database for the user and returns the total count
	public static function messagecount() {
		$messages = DB::table('messages')->where('receiver_id', Auth::id())->where('is_read', "No")->get();
		$replies = DB::table('replies')->where('receiver_id', Auth::id())->where('is_read', "No")->get();
		$icebreakers = DB::table('icebreakers')->where('receiver_id', Auth::id())->where('question1_answer', NULL)->get();
		$total = [];

		if($messages != null) {
			foreach($messages as $message) {
				array_push($total, 1);
			}
		}
		if($replies != null) {
			foreach($replies as $reply) {
				array_push($total, 1);
			}
		}

		if($icebreakers != null) {
			foreach($icebreakers as $ice) {
				array_push($total, 1);
			}
		}
		return count($total);

		// if($messages == null) {
		//  return "0";
		// } else {
		// 	if($replies == null) {
		// 		return count($messages);
		// 	} else {
		// 		return (count($messages) + count($replies));
		// 	}
		// }
	}

// Returns every match that meets the most basic preferences of the user
	public static function allmatches() {
		$user = Auth::user();
		if($user->preference != "All") {
			$matches = DB::table('users')->where('willing', Auth::user()->willing)->where('gender', Auth::user()->preference)->get();
		} else {
			$matches = DB::table('users')->where('willing', $user->willing)->where('preference', $user->gender)->orWhere('preference', "All")->get();
		}
		return $matches;
	}

// Returns only matches that both meet the most basic preferences of the user and are located in the same area. 
	public static function localmatches() {
		$user = Auth::user();
		if($user->preference != "All") {
			$matches = DB::table('users')->where('willing', Auth::user()->willing)->where('gender', Auth::user()->preference)->where('preference', Auth::user()->gender)->where('state', Auth::user()->state)->get();
		} else {
			$matches = DB::table('users')->where('willing', Auth::user()->willing)->where('preference', Auth::user()->gender)->orWhere('preference', "All")->where('state', Auth::user()->state)->get();
		}
		return $matches;
	}

// Returns an array of matches who the user has not voted on yet.
	public static function unvotedmatches() {
		$available = [];
		$user = Auth::user();
		if($user->preference != "All") {
			$matches = DB::table('users')->where('gender', Auth::user()->preference)->where('preference', Auth::user()->gender)->where('willing', Auth::user()->willing)->get();
		} else {
			$matches = DB::table('users')->where('preference', Auth::user()->gender)->orWhere('preference', "All")->where('willing', Auth::user()->willing)->get();
		}
		foreach($matches as $match) {
			$vote = DB::table('votes')->where('subject_id', $match->id)->where('voter_id', $user->id)->get();
			if($vote == null) {
				array_push($available, $match);
			} 
		}
		return $available;
	}

// Compares the details the user filled out with the details the other user filled out. Returns a percentage based on how many things they have in common.
	public static function percent_match($id) {
		$things_in_common = [];
		$driver = Auth::user();
		$dds = DB::table('details')->where('user_id', $driver->id)->get();
		$subject = User::find($id);
		$sds = DB::table('details')->where('user_id', $subject->id)->get();
		if($driver->preference == $subject->gender) {
			array_push($things_in_common, 1);
		} else if($driver->preference = "All" || $subject->preference = "All") {
			array_push($things_in_common, 1);
		}
		if($driver->ethnicity == $subject->ethnicity) {
			array_push($things_in_common, 1);
		}
		if($driver->city == $subject->city) {
			array_push($things_in_common, 1);
		}
		if($driver->state == $subject->state) {
			array_push($things_in_common, 1);
		}
		if($driver->zipcode == $subject->zipcode) {
			array_push($things_in_common, 1);
		}
		if($driver->willing == $subject->willing) {
			array_push($things_in_common, 1);
		}
		foreach($dds as $detail) {
			foreach($sds as $subdetail) {
				if($detail->personality == $subdetail->personality) {
					array_push($things_in_common, 1);
				} 
				if($detail->marital_status == $subdetail->marital_status) {
					array_push($things_in_common, 1);
				}
				if($detail->children == $subdetail->children) {
					array_push($things_in_common, 1);
				}
				if($detail->want_children == $subdetail->want_children) {
					array_push($things_in_common, 1);
				}
				if($detail->religion == $subdetail->religion) {
					array_push($things_in_common, 1);
				}
				if($detail->politics == $subdetail->politics) {
					array_push($things_in_common, 1);
				}
				if($detail->income == $subdetail->income) {
					array_push($things_in_common, 1);
				}
				if($detail->hair_color == $subdetail->hair_color) {
					array_push($things_in_common, 1);
				}
				if($detail->hair_length == $subdetail->hair_length) {
					array_push($things_in_common, 1);
				}
				if($detail->eye_color == $subdetail->eye_color) {
					array_push($things_in_common, 1);
				}
				if($detail->body_type == $subdetail->body_type) {
					array_push($things_in_common, 1);
				}
				if($detail->can_host == $subdetail->can_host) {
					array_push($things_in_common, 1);
				}
				if($detail->availability_day == $subdetail->availability_day) {
					array_push($things_in_common, 1);
				}
				if($detail->availability_time == $subdetail->availability_time) {
					array_push($things_in_common, 1);
				}
			}
		}
		$total = ceil((count($things_in_common) * 100)/20);
		return $total;
	}
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
