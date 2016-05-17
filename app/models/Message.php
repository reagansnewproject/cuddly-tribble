<?php

class Message extends Eloquent {

	protected $table = 'messages';

	public function users() {
		$this->hasMany('User');
	}

	public function images() {
		$this->hasMany('Image');
	}

	public function replies() {
		$this->hasMany('Reply');
	}
}
?>