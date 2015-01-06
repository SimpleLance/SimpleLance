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

