<?php

class DashboardController extends BaseController {

	protected $ticket;

	public function __construct(Ticket $ticket)
	{
		$this->ticket = $ticket;
	}

	public function index()
	{
		if (Sentry::inGroup(Sentry::findGroupByName('Admins')))
		{
			$openTickets = $this->ticket->getOpenTickets();
			$inProgressTickets = $this->ticket->getInProgressTickets();


			return View::make('dashboard.admin')
				->with('openTickets', $openTickets)
				->with('inProgressTickets', $inProgressTickets);
		} else {

			return View::make('dashboard.user');
		}
	}


}