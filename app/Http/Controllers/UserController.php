<?php namespace SimpleLance;

use Illuminate\Support\Facades\View;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class UserController extends \Sentinel\UserController
{
    public function __construct()
    {
        $this->beforeFilter('Sentinel\hasAccess:admin', ['only' => ['index', 'create', 'add', 'destroy', 'suspend', 'unsuspend', 'ban', 'unban']]);
    }

    public function show($id)
    {
        $user = Sentry::findUserById($id);

        if ($user == null || !is_numeric($id)) {
            // @codeCoverageIgnoreStart
            return \App::abort(404);
            // @codeCoverageIgnoreEnd
        }

        $isOwner = $this->profileOwner($id);
        if ($isOwner !== true) {
            return $isOwner;
        }

        return View::make('Sentinel::users.show')->with('user', $user);
    }
}
