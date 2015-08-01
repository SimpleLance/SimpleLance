<?php
use SimpleLance\User;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class Status extends Model {
	protected $fillable = ['title'];

	public function projects()
	{
		$this->hasMany('Project');
	}

	public function getStatuses()
	{
		$allStatuses = Status::all();
		$statuses = [];

		foreach ($allStatuses as $thisStatus)
		{
			$statuses[$thisStatus->id] = $thisStatus->title;
		}

		return $statuses;
	}

	public function getStatusByName($name)
	{
		return Status::where('title', $name)->firstOrFail();
	}
}