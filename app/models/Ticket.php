<?php

class Ticket extends \Eloquent {
	protected $fillable = [
		'title',
		'description',
		'priority_id',
		'status_id',
		'owner_id',
		'replies'
	];

	public function owner() {

		return $this->belongsTo('User');
	}

	public function priority() {

		return $this->belongsTo('Priority');
	}

	public function status() {
		return $this->belongsTo('Status');
	}

}