<?php

class Invoice extends \Eloquent {
	protected $fillable = [
		'title',
		'due',
		'status_id',
		'amount',
		'owner_id'
	];

	public function owner() {

		return $this->belongsTo('User');
	}
}