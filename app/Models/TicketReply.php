<?php
use App\User;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class TicketReply extends \Eloquent {
	protected $fillable = [
		'ticket_id',
		'user_id',
		'content'
	];

	public function user() {

		return $this->belongsTo('App\User');
	}

}