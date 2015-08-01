<?php namespace App\Http\Controllers;

class ProjectsController extends \BaseController {

	protected $project;

	public function __construct(Project $project, User $user, Status $status, Priority $priority)
	{
		$this->project = $project;
		$this->user = $user;
		$this->status = $status;
		$this->priority = $priority;

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
	 * GET /projects
	 *
	 * @return Response
	 */
	public function index()
	{
		$statuses = $this->status->getStatuses();
		$projects = $this->project
			->with('owner')
			->where('status_id', '1')
			->orderBy('updated_at', 'ASC')
			->get();

		return View::make('projects.index')
			->with('statuses', $statuses)
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
		$priorities = $this->priority->getPriorities();

		return View::make('projects.create')
			->with('owners', $owners)
			->with('statuses', $statuses)
			->with('priorities', $priorities);
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
			'priority_id' => 'required',
			'owner_id' => 'required'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			return Redirect::route('projects.create')
				->withErrors($validator)
				->withInput($input);
		} else {
			$project = $this->project->create($input);

			return Redirect::route('projects.index')->with('success', [
				'class' => 'success',
				'text' => 'Project Created.'
			]);
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
		$project = $this->project->find($id);

		return View::make('projects.show')
			->with('project', $project);
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
		$project = $this->project->find($id);
		$owners = $this->user->getOwners();
		$statuses = $this->status->getStatuses();
		$priorities = $this->priority->getPriorities();

		return View::make('projects.edit')
			->with('project', $project)
			->with('owners', $owners)
			->with('statuses', $statuses)
			->with('priorities', $priorities);
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
		$input = Input::all();

		$rules = array(
			'title' => 'required',
			'description' => 'required',
			'status_id' => 'required',
			'priority_id' => 'required',
			'owner_id' => 'required'
		);

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {

			return Redirect::route('projects.edit', $id)
				->withErrors($validator)
				->withInput($input);
		} else {

			$project = $this->project->find($id);
			$project->title = $input['title'];
			$project->description = $input['description'];
			$project->status_id = $input['status_id'];
			$project->priority_id = $input['priority_id'];
			$project->owner_id = $input['owner_id'];

			$project->save();

			return Redirect::route('projects.index')->with('success', [
				'class' => 'success',
				'text' => 'Project Updated.'
			]);
		}
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
		if ($this->project->destroy($id))
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

		return Redirect::action('ProjectsController@index')->with($status);
	}

	public function filterByStatus($statusName)
	{
		try {
			$status = $this->status->getStatusByName($statusName);
		} catch(Exception $e) {

			return Redirect::route('projects.index')->with('flash', [
				'class' => 'info',
				'message' => 'Invalid Status Name.'
			]);
		}
		$statuses = $this->status->getStatuses();
		$projects = $this->project
			->with('owner')
			->where('status_id', $status->id)
			->orderBy('updated_at', 'ASC')
			->get();

		return View::make('projects.index')
		           ->with('statuses', $statuses)
		           ->with('projects', $projects);
	}
}