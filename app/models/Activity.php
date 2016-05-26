<?php
class Activity extends Eloquent {
	protected $table = 'activities';

	public function user() {
		$this->belongsTo('User');
	}
}
?>