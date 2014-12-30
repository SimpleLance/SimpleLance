@extends('layouts.default')

@section('content')
    <h4>Edit Project</h4>
    <div class="well">
        {{ Form::open(array(
            'action' => array('ProjectsController@update', $project->id),
            'method' => 'put',
            'class' => 'form-horizontal',
            'role' => 'form'
            )) }}

        <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}" for="title">
            {{ Form::label('edit_title', 'Title', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::text('title', $project->title, array('class' => 'form-control', 'placeholder' => 'Title', 'id' => 'edit_title'))}}
            </div>
            {{ ($errors->has('title') ? $errors->first('title') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}" for="description">
            {{ Form::label('edit_description', 'Description', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::text('description', $project->description, array('class' => 'form-control', 'placeholder' => 'Description', 'id' => 'edit_description'))}}
            </div>
            {{ ($errors->has('description') ? $errors->first('description') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('status_id')) ? 'has-error' : '' }}" for="status_id">
            {{ Form::label('edit_status_id', 'Status', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::select('status_id', $statuses, $project->status_id) }}
            </div>
            {{ ($errors->has('status_id') ? $errors->first('status_id') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('priority_id')) ? 'has-error' : '' }}" for="priority_id">
            {{ Form::label('edit_priority_id', 'Priority', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::select('priority_id', $priorities, $project->priority_id) }}
            </div>
            {{ ($errors->has('priority_id') ? $errors->first('priority_id') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('owner_id')) ? 'has-error' : '' }}" for="owner_id">
            {{ Form::label('edit_owner_id', 'Owner', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::select('owner_id', $owners, $project->owner_id) }}
            </div>
            {{ ($errors->has('owner_id') ? $errors->first('owner_id') : '') }}
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::hidden('id', $project->id) }}
                {{ Form::submit('Submit Changes', array('class' => 'btn btn-primary'))}}
            </div>
        </div>
        {{ Form::close()}}
    </div>
@stop

