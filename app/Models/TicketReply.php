<?php
use SimpleLance\User;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class TicketReply extends \Eloquent {
	protected $fillable = [
		'ticket_id',
		'user_id',
		'content'
	];

	public function user() {

		return $this->belongsTo('SimpleLance\User');
	}

}