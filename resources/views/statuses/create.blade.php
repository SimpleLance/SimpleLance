@extends('layouts.default')

@section('content')
    <div class="well">
        {!! Form::open(array('action' => 'StatusesController@store')) !!}

        <h4>Create New Status</h4>

        <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
            {!! Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Title')) !!}
            {{ ($errors->has('title') ? $errors->first('title') : '') }}
        </div>

        {!! Form::submit('Create', array('class' => 'btn btn-primary create')) !!}

        {!! Form::close() !!}

    </div>
@stop

