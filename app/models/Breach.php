<?php
class Breach extends Eloquent {
	protected $table = "breaches";

	public function user() {
		$this->belongsTo('User');
	}
}
?>