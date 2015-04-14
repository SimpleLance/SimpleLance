@extends('layouts.default')

@section('content')
    <h4>Edit Priority</h4>
    <div class="well">
        {!! Form::open(array(
            'action' => array('PrioritiesController@update', $priority->id),
            'method' => 'put',
            'class' => 'form-horizontal',
            'role' => 'form'
            )) !!}

        <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}" for="title">
            {!! Form::label('edit_title', 'Title', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!! Form::text('title', $priority->title, array('class' => 'form-control', 'placeholder' => 'Title', 'id' => 'edit_title')) !!}
            </div>
            {{ ($errors->has('title') ? $errors->first('title') : '') }}
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::hidden('id', $priority->id) !!}
                {!! Form::submit('Submit Changes', array('class' => 'btn btn-primary')) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop

