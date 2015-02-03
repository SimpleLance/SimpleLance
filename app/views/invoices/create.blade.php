@extends('layouts.default')

@section('content')
    <div class="well">
        {{ Form::open(array('action' => 'InvoicesController@store')) }}

        <h4>Create New Invoice</h4>

        <div class="form-group {{ ($errors->has('due')) ? 'has-error' : '' }}">
            {{ Form::label('due', 'Due Date', array('class' => '')) }}
            {{ Form::text('due', null, array('class' => 'input-xs datepicker', 'placeholder' => 'Due Date', 'id' => 'calendar')) }}
            {{ ($errors->has('due') ? $errors->first('due') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('owner_id')) ? 'has-error' : '' }}" for="owner_id">
            {{ Form::label('edit_owner_id', 'Owner', array('class' => '')) }}
            {{ Form::select('owner_id', $owners, null) }}
            {{ ($errors->has('owner_id') ? $errors->first('owner_id') : '') }}
        </div>

        {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@stop

