<?php
use SimpleLance\User;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class Priority extends \Eloquent
{
    protected $fillable = ['title'];

    public function tickets()
    {
        $this->hasMany('Ticket');
    }

    public function getPriorities()
    {
        $allPriorities = Priority::all();
        $priorities = [];

        foreach ($allPriorities as $thisPriority) {
            $priorities[$thisPriority->id] = $thisPriority->title;
        }

        return $priorities;
    }
}
