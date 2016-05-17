<?php
class Reply extends Eloquent {
	protected $table = 'replies';

	public function message() {
		$this->belongsTo('Message');
	}

	
}
?>