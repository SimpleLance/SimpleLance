@extends('layouts.default')

@section('content')
    <h4>Edit Invoice</h4>
    <div class="well">
        {!!  Form::open(array(
            'action' => array('InvoicesController@update', $invoice->id),
            'method' => 'put',
            'class' => 'form-horizontal',
            'role' => 'form'
            )) !!}

        <div class="form-group {{ ($errors->has('due')) ? 'has-error' : '' }}" for="due">
            {!!  Form::label('edit_due', 'Due Date', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('due', $invoice->due, array('class' => 'form-control', 'placeholder' => 'Description', 'id' => 'edit_due')) !!}
            </div>
            {{ ($errors->has('due') ? $errors->first('due') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('status_id')) ? 'has-error' : '' }}" for="status_id">
            {!!  Form::label('edit_status_id', 'Status', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::select('status_id', $statuses, $invoice->status_id) !!}
            </div>
            {{ ($errors->has('status_id') ? $errors->first('status_id') : '') }}
        </div>

        <div class="form-group {{ ($errors->has('owner_id')) ? 'has-error' : '' }}" for="owner_id">
            {!!  Form::label('edit_owner_id', 'Owner', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::select('owner_id', $owners, $invoice->owner_id) !!}
            </div>
            {{ ($errors->has('owner_id') ? $errors->first('owner_id') : '') }}
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!!  Form::hidden('id', $invoice->id) !!}
                {!!  Form::submit('Submit Changes', array('class' => 'btn btn-primary', 'id' => 'update')) !!}
            </div>
        </div>
        {!!  Form::close() !!}
    </div>
@stop

