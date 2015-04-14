<?php
use App\User;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

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

		return $this->belongsTo('App\User');
	}

	public function priority() {

		return $this->belongsTo('Priority');
	}

	public function status() {
		return $this->belongsTo('Status');
	}

	public function getOpenTickets() {

		return Ticket::where('status_id', '=', '1')->get();
	}

	public function getInProgressTickets() {

		return Ticket::where('status_id', '=', '2')->get();
	}

	public function getOpenTicketsByUser() {

		return Ticket::where('status_id', '=', '1')
			->where('owner_id', '=', Sentry::getUser()->id)
			->get();
	}

	public function getInProgressTicketsByUser() {

		return Ticket::where('status_id', '=', '2')
			->where('owner_id', '=', Sentry::getUser()->id)
			->get();
	}
}