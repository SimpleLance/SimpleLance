<?php

class DashboardController extends BaseController {

	protected $ticket;
	protected $project;

	public function __construct(Ticket $ticket, Project $project)
	{
		$this->ticket = $ticket;
		$this->project = $project;
	}

	public function index()
	{
		if (Sentry::inGroup(Sentry::findGroupByName('Admins')))
		{
			$openTickets = $this->ticket->getOpenTickets();
			$inProgressTickets = $this->ticket->getInProgressTickets();
			$openProjects = $this->project->getOpenProjects();
			$inProgressProjects = $this->project->getInProgressProjects();

			return View::make('dashboard.admin')
				->with('openTickets', $openTickets)
				->with('inProgressTickets', $inProgressTickets)
				->with('openProjects', $openProjects)
				->with('inProgressProjects', $inProgressProjects);
		} else {

			return View::make('dashboard.user');
		}
	}


}