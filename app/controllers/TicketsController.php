<?php

class TicketsController extends \BaseController {

	protected $ticket;

	public function __construct(Ticket $ticket, User $user)
	{
		$this->ticket = $ticket;
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 * GET /tickets
	 *
	 * @return Response
	 */
	public function index()
	{
		$tickets = $this->ticket->all();

		return View::make('tickets.index')
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

		return View::make('tickets.create')
			->with('owners', $owners);
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
			'priority_id' => 'integer|required',
			'owner_id' => 'integer|required'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			return Redirect::route('tickets.create')
				->withErrors($validator)
				->withInput($input);
		} else {
			$ticket = $this->ticket->create($input);

			Redirect::route('tickets.index')->with('flash', [
				'class' => 'success',
				'message' => 'Ticket Created.'
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
		$thisTicket = $this->ticket->with('owner')->find($id);

		return View::make('tickets.show')
		           ->with('ticket', $thisTicket);
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

		return View::make('tickets.edit')
			->with('ticket', $thisTicket)
			->with('owners', $owners);
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
		//
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
		//
	}

}