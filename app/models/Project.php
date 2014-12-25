<?php

class Project extends \Eloquent {
	protected $fillable = [
		'title',
		'description',
		'owner_id',
		'status_id'
	];

	public function owner() {

		return $this->belongsTo('User');
	}

	public function status() {

		return $this->belongsTo('Status');
	}
}