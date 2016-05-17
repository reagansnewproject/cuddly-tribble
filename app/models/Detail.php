<?php

class Detail extends Eloquent {

	protected $table = 'details';

	public function user() {
		$this->belongsTo('User');
	}
}
?>