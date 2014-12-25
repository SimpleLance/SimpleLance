<?php

class StatusesController extends \BaseController {

	protected $status;

	public function __construct(Status $status)
	{
		$this->status = $status;
	}

	/**
	 * Display a listing of the resource.
	 * GET /statuses
	 *
	 * @return Response
	 */
	public function index()
	{
		$statuses = $this->status->all();

		return View::make('statuses.index')
		           ->with('statuses', $statuses);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /statuses/create
	 *
	 * @return Response
	 */
	public function create()
	{

		return View::make('statuses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /statuses
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$rules = array(
			'title' => 'required'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			return Redirect::route('statuses.create')
			               ->withErrors($validator)
			               ->withInput($input);
		} else {
			$status = $this->status->create($input);

			return Redirect::route('statuses.index')->with('flash', [
				'class' => 'success',
				'message' => 'Status Created.'
			]);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /statuses/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$thisStatus = $this->status->find($id);


		return View::make('statuses.edit')
		           ->with('status', $thisStatus);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /statuses/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();

		$rules = array(
			'title' => 'required'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			return Redirect::route('statuses.edit', $id)
			               ->withErrors($validator)
			               ->withInput($input);
		} else {

			$status = $this->status->find($id);
			$status->title = $input['title'];

			$status->save();

			return Redirect::route('statuses.index')->with('flash', [
				'class' => 'success',
				'message' => 'Status Updated.'
			]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /statuses/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ($this->status->destroy($id))
		{
			Session::flash('success', 'Status Deleted');
		} else {
			Session::flash('error', 'Unable to Delete Status');
		}

		return Redirect::action('StatusesController@index');
	}

}