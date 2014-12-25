<?php

class ProjectsController extends \BaseController {

	protected $project;

	public function __construct(Project $project, User $user, Status $status)
	{
		$this->project = $project;
		$this->user = $user;
		$this->status = $status;
	}

	/**
	 * Display a listing of the resource.
	 * GET /projects
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = $this->project->with('owner')->get();

		return View::make('projects.index')
			->with('projects', $projects);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /projects/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$owners = $this->user->getOwners();
		$statuses = $this->status->getStatuses();

		return View::make('projects.create')
			->with('owners', $owners)
			->with('statuses', $statuses);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /projects/create
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$rules = array(
			'title' => 'required',
			'description' => 'required',
			'status_id' => 'required',
			'owner_id' => 'required'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			return Redirect::route('projects.create')
				->withErrors($validator)
				->withInput($input);
		} else {
			$project = $this->project->create($input);

			Session::flash('success', 'Project Created');

			return Redirect::route('projects.index');
		}
	}

	/**
	 * Display the specified resource.
	 * GET /projects/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$thisProject = $this->project->find($id);

		return View::make('projects.show')
			->with('project', $thisProject);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /projects/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$thisProject = $this->project->find($id);

		return View::make('projects.edit')
		           ->with('project', $thisProject);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /projects/{id}
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
	 * DELETE /projects/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}