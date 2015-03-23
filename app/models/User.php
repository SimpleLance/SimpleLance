<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function projects() {

		return $this->hasMany('Project');
	}

	public function invoices() {

		return $this->hasMany('Invoice');
	}

	public function getOwners()
	{
		$allOwners = User::all();
		$owners = [];

		foreach ($allOwners as $thisOwner)
		{
			if (empty($thisOwner->username))
			{
				$thisOwner->username =  $thisOwner->email;
			}

			$owners[$thisOwner->id] = $thisOwner->username;
		}

		return $owners;
	}

}
