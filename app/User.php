<?php namespace SimpleLance;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

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
