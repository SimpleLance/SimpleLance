<?php
use SimpleLance\User;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class Priority extends Model {
	protected $fillable = ['title'];

	public function tickets()
	{
		$this->hasMany('Ticket');
	}

	public function getPriorities()
	{
		$allPriorities = Priority::all();
		$priorities = [];

		foreach ($allPriorities as $thisPriority)
		{
			$priorities[$thisPriority->id] = $thisPriority->title;
		}

		return $priorities;
	}

}