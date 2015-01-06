<?php

class InvoicesController extends \BaseController {

	protected $invoice;

	public function __construct(Invoice $invoice, User $user, Status $status)
	{
		$this->invoice = $invoice;
		$this->user = $user;
		$this->status = $status;

		$this->beforeFilter('Sentinel\inGroup:Admins',
			[
				'only' => [
					'create',
					'destroy',
					'update',
					'edit'
				]
			]
		);
	}

	/**
	 * Display a listing of the resource.
	 * GET /invoices
	 *
	 * @return Response
	 */
	public function index()
	{
		$invoices = $this->invoice->with('owner')->with('status')->get();

		return View::make('invoices.index')
		           ->with('invoices', $invoices);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /invoices/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$owners = $this->user->getOwners();
		$statuses = $this->status->getStatuses();

		return View::make('invoices.create')
		           ->with('owners', $owners)
		           ->with('statuses', $statuses);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /invoices
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$rules = array(
			'title' => 'required',
			'due' => 'required',
			'status_id' => 'required',
			'owner_id' => 'required'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			return Redirect::route('invoices.create')
			               ->withErrors($validator)
			               ->withInput($input);
		} else {
			$invoice = $this->invoice->create($input);

			return Redirect::route('invoices.index')->with('flash', [
				'class' => 'success',
				'message' => 'Invoice Created.'
			]);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /invoices/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$thisInvoice = $this->invoice->with('owner')->with('status')->find($id);

		return View::make('invoices.show')
		           ->with('invoice', $thisInvoice);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /invoices/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$thisInvoice = $this->invoice->find($id);
		$owners = $this->user->getOwners();
		$statues = $this->status->getStatuses();

		return View::make('invoices.edit')
		           ->with('invoice', $thisInvoice)
		           ->with('owners', $owners)
		           ->with('statuses', $statues);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /invoices/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();

		$rules = array(
			'title' => 'required',
			'due' => 'required',
			'status_id' => 'required',
			'owner_id' => 'required'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			return Redirect::route('invoices.edit', $id)
			               ->withErrors($validator)
			               ->withInput($input);
		} else {

			$invoice = $this->invoice->find($id);
			$invoice->title = $input['title'];
			$invoice->due = $input['due'];
			$invoice->status_id = $input['status_id'];
			$invoice->owner_id = $input['owner_id'];

			$invoice->save();

			return Redirect::route('invoices.index')->with('flash', [
				'class' => 'success',
				'message' => 'Invoice Updated.'
			]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /invoices/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ($this->invoice->destroy($id))
		{
			Session::flash('success', 'Invoice Deleted');
		} else {
			Session::flash('error', 'Unable to Delete Invoice');
		}

		return Redirect::action('InvoicesController@index');
	}

}