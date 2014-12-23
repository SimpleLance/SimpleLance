@extends('layouts.default')

@section('content')
    <div class="well">
        {{ Form::open(array('action' => 'Sentinel\UserController@store')) }}

        <h4>Create New Support Ticket</h4>

        <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
            {{ Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Title')) }}
            {{ ($errors->has('title') ? $errors->first('title') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
            {{ Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Description')) }}
            {{ ($errors->has('description') ? $errors->first('description') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('priority')) ? 'has-error' : '' }}" for="priority">
            {{ Form::label('edit_priority', 'Priority', array('class' => '')) }}
                TODO: This should be a drop down of Priorities
            {{ ($errors->has('priority') ? $errors->first('priority') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('owner')) ? 'has-error' : '' }}" for="owner">
            {{ Form::label('edit_owner', 'Owner', array('class' => '')) }}
                {{ Form::select('owner', $owners, null) }}
            {{ ($errors->has('owner') ? $errors->first('owner') : '') }}
        </div>

        {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@stop

