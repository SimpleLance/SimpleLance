@extends('layouts.default')

@section('content')
    <div class="well">
        {{ Form::open(array('action' => 'ProjectsController@store')) }}

        <h4>Create New Project</h4>

        <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
            {{ Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Title')) }}
            {{ ($errors->has('title') ? $errors->first('title') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
            {{ Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Description')) }}
            {{ ($errors->has('description') ? $errors->first('description') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('status_id')) ? 'has-error' : '' }}" for="status_id">
            {{ Form::label('edit_status_id', 'Status', array('class' => '')) }}
            {{ Form::select('status_id', $statuses, null) }}
            {{ ($errors->has('status_id') ? $errors->first('status_id') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('owner_id')) ? 'has-error' : '' }}" for="owner_id">
            {{ Form::label('edit_owner_id', 'Owner', array('class' => '')) }}
            {{ Form::select('owner_id', $owners, null) }}
            {{ ($errors->has('owner_id') ? $errors->first('owner_id') : '') }}
        </div>

        {{ Form::submit('Create', array('class' => 'btn btn-primary create')) }}

        {{ Form::close() }}

    </div>
@stop

