<?php

class Project extends \Eloquent {
	protected $fillable = [
		'title',
		'description',
		'owner_id',
		'status_id'
	];

	public function user() {

		return $this->belongsTo('User');
	}
}