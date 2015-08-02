<?php
use SimpleLance\User;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class Project extends \Eloquent
{
    protected $fillable = [
        'title',
        'description',
        'owner_id',
        'status_id',
        'priority_id'
    ];

    public function owner()
    {
        return $this->belongsTo('SimpleLance\User');
    }

    public function status()
    {
        return $this->belongsTo('Status');
    }

    public function priority()
    {
        return $this->belongsTo('Priority');
    }

    public function getOpenProjects()
    {
        return Project::where('status_id', '=', '1')->get();
    }

    public function getInProgressProjects()
    {
        return Project::where('status_id', '=', '2')->get();
    }

    public function getOpenProjectsByUser()
    {
        return Project::where('status_id', '=', '1')
            ->where('owner_id', '=', Sentry::getUser()->id)
            ->get();
    }

    public function getInProgressProjectsByUser()
    {
        return Project::where('status_id', '=', '2')
            ->where('owner_id', '=', Sentry::getUser()->id)
            ->get();
    }
}
