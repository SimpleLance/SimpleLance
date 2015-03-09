@extends('layouts.default')

@section('content')
    <h4>Project</h4>

    <div class="well clearfix">
        <div class="col-md-7">
            <p><strong>Title</strong>: {{ $project->title }}</p>
            <p><strong>Description</strong>: {{ $project->description }}</p>
            <p><strong>Status</strong>: {{ $project->status->title }}</p>
            <p><strong>Priority</strong>: {{ $project->priority->title }}</p>
            <p><strong>Owner</strong>: {{ $project->owner->username }}</p>

        </div>
        <div class="col-md-5">

            <p><em>Project created: {{ date("D, F d Y",strtotime($project->created_at)) }}</em></p>
            <p><em>Last Updated: {{ date("D, F d Y",strtotime($project->updated_at)) }} at {{ date("g:h a",strtotime($project->updated_at)) }}</em></p>
            <button id="edit-{{ $project->id }}" class="btn btn-primary" onClick="location.href='{{ action('ProjectsController@edit', array($project->id)) }}'">Edit Project</button>
        </div>
        <div class="col-md-2">
            {{ Form::open(array(
                 'action' => array('ProjectsController@destroy', $project->id),
                 'method' => 'delete',
                 'class' => $project->id . '-delete',
                 'id' => $project->id . '-delete',
                 'name' => $project->id . '-delete',
                 'role' => ''
                 )) }}

            {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'id' => 'delete-' . $project->id])}}
            {{ Form::close() }}
        </div>
    </div>
@stop

