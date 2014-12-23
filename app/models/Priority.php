<?php

class Priority extends \Eloquent {
	protected $fillable = ['title'];

	public function tickets()
	{
		$this->hasMany('Ticket');
	}


}