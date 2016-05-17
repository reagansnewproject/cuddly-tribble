<?php

class Image extends Eloquent {

	protected $table = 'images';

	public function user() {
		$this->belongsTo('User');
	}

	public function message() {
		$this->belongsTo('Message');
	}
}
?>