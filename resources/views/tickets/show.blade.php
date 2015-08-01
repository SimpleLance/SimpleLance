@extends('layouts.default')

@section('content')
    <h4>Support Ticket</h4>

    <div class="well col-md-6">
        <div class="col-md-6">
            <p><strong>Subject</strong>: {{ $ticket->title }}</p>
            <p><strong>Owner</strong>: {{ $ticket->owner->username }}</p>
            <p><strong>Priority</strong>: {{ $ticket->priority->title }}</p>
            <p><strong>Status</strong>: {{ $ticket->status->title }}</p>
            <p><strong>Ticket created</strong>: {{ date("D, F d Y",strtotime($ticket->created_at)) }}</p>
            <p><strong>Last Updated</strong>: {{ date("D, F d Y",strtotime($ticket->updated_at)) }} at {{ date("g:i a",strtotime($ticket->updated_at)) }}</p>

            <button id="edit-{{ $ticket->id }}" class="btn btn-primary" onClick="location.href='{{ action('TicketsController@edit', array($ticket->id)) }}'">Edit Ticket</button>

            {!! Form::open(array(
                 'action' => array('TicketsController@destroy', $ticket->id),
                 'method' => 'delete',
                 'class' => $ticket->id . '-delete',
                 'id' => $ticket->id . '-delete',
                 'name' => $ticket->id . '-delete',
                 'role' => ''
                 )) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'id' => 'delete-' . $ticket->id]) !!}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="well col-md-6">
        <div>
            <em>Ticket opened by</em> <b>{{ $ticket->owner->username }}</b>
            <em>on</em> <b>{{ date("D, F d Y",strtotime($ticket->created_at)) }} at {{ date("g:i a",strtotime($ticket->created_at)) }}</b>
            <br>
            &nbsp;{{ $ticket->description }}
            <hr>
        </div>

        @foreach($replies as $reply)
            <div>
                <em>Reply by</em> <b>{{ $reply->user->username }}</b>
                <em>on</em> <b>{{ date("D, F d Y",strtotime($reply->created_at)) }} at {{ date("g:i a",strtotime($reply->created_at)) }}</b>
                <br>
                &nbsp;{{ $reply->content }}
                <hr>
            </div>
        @endforeach

            <div>
                {!! Form::open(array(
                        'action' => array('TicketsController@reply', $ticket->id),
                        'method' => 'post',
                        'class' => 'form-horizontal',
                        'role' => 'form'
                        )) !!}

                <div class="form-group {{ ($errors->has('content')) ? 'has-error' : '' }}">
                    {!! Form::textarea('content', null, array('class' => 'form-control', 'placeholder' => 'Your Reply')) !!}
                    {{ ($errors->has('content') ? $errors->first('content') : '') }}
                </div>

                <div class="form-group {{ ($errors->has('priority_id')) ? 'has-error' : '' }}" for="priority_id">
                    {!! Form::label('edit_priority_id', 'Priority', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::select('priority_id', $priorities, $ticket->priority_id) !!}
                    </div>
                    {{ ($errors->has('priority_id') ? $errors->first('priority_id') : '') }}
                </div>

                <div class="form-group {{ ($errors->has('status_id')) ? 'has-error' : '' }}" for="status_id">
                    {!! Form::label('edit_status_id', 'Status', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::select('status_id', $statuses, $ticket->status_id) !!}
                    </div>
                    {{ ($errors->has('status_id') ? $errors->first('status_id') : '') }}
                </div>

                {!! Form::submit('Submit Reply', array('class' => 'btn btn-primary')) !!}

                {!! Form::close() !!}
            </div>
    </div>
@stop

