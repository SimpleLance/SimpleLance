<?php

class Ticket extends \Eloquent {
	protected $fillable = [
		'title',
		'description',
		'priority_id',
		'owner_id'
	];

	public function user() {

		return $this->belongsTo('User');
	}
}