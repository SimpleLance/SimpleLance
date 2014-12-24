<?php

class Status extends \Eloquent {
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
}