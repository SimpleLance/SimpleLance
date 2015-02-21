<?php

class TicketsController extends \BaseController {

	protected $ticket;

	public function __construct(Ticket $ticket, User $user, Priority $priority, Status $status, TicketReply $ticketReply)
	{
		$this->ticket = $ticket;
		$this->user = $user;
		$this->priority = $priority;
		$this->status = $status;
		$this->replies = $ticketReply;

		$this->beforeFilter('Sentinel\inGroup:Admins',
			[
				'only' => [
					'destroy',
					'edit'
				]
			]
		);
	}

	/**
	 * Display a listing of the resource.
	 * GET /tickets
	 *
	 * @return Response
	 */
	public function index()
	{
		$statuses = $this->status->getStatuses();
		$tickets = $this->ticket
			->with('owner')
			->where('status_id', '1')
			->orderBy('updated_at', 'ASC')
			->get();

		return View::make('tickets.index')
					->with('statuses', $statuses)
					->with('tickets', $tickets);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tickets/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$owners = $this->user->getOwners();
		$priorities = $this->priority->getPriorities();
		$statuses = $this->status->getStatuses();

		return View::make('tickets.create')
			->with('owners', $owners)
			->with('priorities', $priorities)
			->with('statuses', $statuses);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tickets
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$rules = array(
			'title' => 'required',
			'description' => 'required',
			'priority_id' => 'required',
			'status_id' => 'required',
			'owner_id' => 'required'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			return Redirect::route('tickets.create')
				->withErrors($validator)
				->withInput($input);
		} else {
			$input['replies'] = 0;
			$this->ticket->create($input);

			return Redirect::route('tickets.index')->with('success', [
				'class' => 'success',
				'text' => 'Ticket Created.'
			]);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /tickets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ticket = $this->ticket->find($id);
		$statuses = $this->status->getStatuses();
		$priorities = $this->priority->getPriorities();
		$replies = $this->replies->with('user')->where('ticket_id', $id)->orderBy('updated_at', 'ASC')->get();

		return View::make('tickets.show')
		           ->with('ticket', $ticket)
				   ->with('statuses', $statuses)
				   ->with('priorities', $priorities)
			       ->with('replies', $replies);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /tickets/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$thisTicket = $this->ticket->find($id);
		$owners = $this->user->getOwners();
		$priorities = $this->priority->getPriorities();
		$statuses = $this->status->getStatuses();

		return View::make('tickets.edit')
			->with('ticket', $thisTicket)
			->with('owners', $owners)
			->with('priorities', $priorities)
			->with('statuses', $statuses);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tickets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();

		$rules = array(
			'priority_id' => 'required',
			'status_id' => 'required',
			'owner_id' => 'required'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			return Redirect::route('tickets.edit', $id)
			               ->withErrors($validator)
			               ->withInput($input);
		} else {

			$ticket = $this->ticket->find($id);
			$ticket->priority_id = $input['priority_id'];
			$ticket->status_id = $input['status_id'];
			$ticket->owner_id = $input['owner_id'];

			$ticket->save();

			return Redirect::route('tickets.index')->with('success', [
				'class' => 'success',
				'text' => 'Ticket Updated.'
			]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /tickets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ($this->ticket->destroy($id))
		{
			$status = [
				'success' => [
					'class' => 'success',
					'text' => 'Ticket Deleted'
				]
			];
		} else {
			$status = [
				'error' => [
					'class' => 'error',
					'text' => 'Unable to Delete Ticket'
				]
			];
		}

		return Redirect::action('TicketsController@index')->with($status);
	}

	/**
	 * Reply to specified ticket
	 * POST /tickets/{id}/reply
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reply($id)
	{
		$input = Input::all();

		$user_id = Sentry::getUser()->id;

		$rules = array(
			'status_id' => 'required',
			'content' => 'required'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			return Redirect::route('tickets.show', $id)
				->withErrors($validator)
				->withInput($input);
		} else {

			TicketReply::create([
				'ticket_id' => $id,
				'user_id' => $user_id,
				'content' => $input['content']
			]);

			$ticket = $this->ticket->find($id);
			$ticket->status_id = $input['status_id'];
			$ticket->priority_id = $input['priority_id'];
			$ticket->replies = $ticket->replies +1;
			$ticket->save();

			return Redirect::route('tickets.index')->with('success', [
				'class' => 'success',
				'text' => 'Ticket Replied To.'
			]);
		}
	}

	public function filterByStatus($statusName)
	{
		try {
			$status = $this->status->getStatusByName($statusName);
		} catch(Exception $e) {

			return Redirect::route('tickets.index')->with('info', [
				'class' => 'info',
				'text' => 'Invalid Status Name.'
			]);
		}
		$statuses = $this->status->getStatuses();
		$tickets = $this->ticket
			->with('owner')
			->where('status_id', $status->id)
			->orderBy('updated_at', 'ASC')
			->get();

		return View::make('tickets.index')
					->with('statuses', $statuses)
					->with('tickets', $tickets);
	}
}