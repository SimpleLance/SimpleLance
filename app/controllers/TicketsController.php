<?php

class TicketsController extends \BaseController {

	protected $ticket;

	public function __construct(Ticket $ticket)
	{
		$this->ticket = $ticket;
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

		return View::make('tickets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tickets
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		$thisTicket = $this->ticket->find($id);

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

		return View::make('tickets.edit')
		           ->with('ticket', $thisTicket);
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