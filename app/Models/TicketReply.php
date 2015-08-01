<?php
use SimpleLance\User;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class TicketReply extends Model {
	protected $fillable = [
		'ticket_id',
		'user_id',
		'content'
	];

	public function user() {

		return $this->belongsTo('SimpleLance\User');
	}

}