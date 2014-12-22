<?php

class Ticket extends \Eloquent {
	protected $fillable = [
		'title',
		'description',
		'priority_id',
		'owner_id'
	];

	public function owner() {

		return $this->belongsTo('User');
	}
}