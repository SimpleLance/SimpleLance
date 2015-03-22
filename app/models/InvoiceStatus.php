<?php

class InvoiceStatus extends \Eloquent {
	protected $fillable = ['title'];

	public function getStatuses()
	{
		$allStatuses = InvoiceStatus::all();
		$statuses = [];

		foreach ($allStatuses as $thisStatus)
		{
			$statuses[$thisStatus->id] = $thisStatus->title;
		}

		return $statuses;
	}
}