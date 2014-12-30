@extends('layouts.default')

@section('content')
    <h4>Edit Support Ticket</h4>
    <div class="well">
        {{ Form::open(array(
            'action' => array('TicketsController@update', $ticket->id),
            'method' => 'put',
            'class' => 'form-horizontal',
            'role' => 'form'
            )) }}

        <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}" for="title">
            {{ Form::label('edit_title', 'Title', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::text('title', $ticket->title, array('class' => 'form-control', 'placeholder' => 'Title', 'id' => 'edit_title'))}}
            </div>
            {{ ($errors->has('title') ? $errors->first('title') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}" for="description">
            {{ Form::label('edit_description', 'Last Name', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::text('description', $ticket->description, array('class' => 'form-control', 'placeholder' => 'Description', 'id' => 'edit_description'))}}
            </div>
            {{ ($errors->has('description') ? $errors->first('description') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('priority_id')) ? 'has-error' : '' }}" for="priority_id">
            {{ Form::label('edit_priority_id', 'Priority', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::select('priority_id', $priorities, $ticket->priority_id) }}
            </div>
            {{ ($errors->has('priority_id') ? $errors->first('priority_id') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('status_id')) ? 'has-error' : '' }}" for="status_id">
            {{ Form::label('edit_status_id', 'Status', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::select('status_id', $statuses, $ticket->status_id) }}
            </div>
            {{ ($errors->has('status_id') ? $errors->first('status_id') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('owner_id')) ? 'has-error' : '' }}" for="owner_id">
            {{ Form::label('edit_owner_id', 'Owner', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::select('owner_id', $owners, $ticket->owner_id) }}
            </div>
            {{ ($errors->has('owner_id') ? $errors->first('owner_id') : '') }}
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::hidden('id', $ticket->id) }}
                {{ Form::submit('Submit Changes', array('class' => 'btn btn-primary'))}}
            </div>
        </div>
        {{ Form::close()}}
    </div>
@stop

