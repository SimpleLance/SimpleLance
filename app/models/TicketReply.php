<?php

class TicketReply extends \Eloquent {
	protected $fillable = [
		'ticket_id',
		'user_id',
		'content'
	];

	public function user() {

		return $this->belongsTo('User');
	}

	public function ticket() {

		return $this->belongsTo('Ticket');
	}
}