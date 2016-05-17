<?php

class Visit extends Eloquent {

	protected $table = 'visits';

	public function user() {
		$this->belongsTo('User');
	}
}
?>