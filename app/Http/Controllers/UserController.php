<?php namespace SimpleLance;

use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter('auth', ['only' => ['index', 'create', 'add', 'destroy', 'suspend', 'unsuspend', 'ban', 'unban']]);
    }

    public function show($id)
    {
        $user = User::find($id);

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
