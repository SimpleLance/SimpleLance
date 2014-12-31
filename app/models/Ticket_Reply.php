<?php

class Ticket_Replies extends \Eloquent {
	protected $fillable = [
		'content',
		'ticket_id',
		'user_id'
	];

	public function ticket() {

		return $this->belongsTo('Ticket');
	}

	public function user() {

		return $this->belongsTo('User');
	}
}