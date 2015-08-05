@extends('layouts.default')

@section('content')
    <h1>Support Tickets</h1>
    <div class="statuses">
        @foreach($statuses as $status)
            <a class="btn btn-default"
               role="button"
               href="/tickets/status/{{ $status }}">{{ $status }}</a>
        @endforeach
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <th>Title</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Replies</th>
            <th>Owner</th>
            <th>Updated At</th>
        </thead>
        <tbody>
        @foreach ($tickets as $ticket)
            @if (Auth::user()->is_admin || $ticket->owner_id == Auth::user()->id)
                <tr>
                    <td>
                        <a href="{{ action('TicketsController@show', array($ticket->id)) }}">
                            {{ $ticket->title }}
                        </a>
                    </td>
                    <td>
                        {{ $ticket->priority->title }}
                    </td>
                    <td>
                        {{ $ticket->status->title }}
                    </td>
                    <td>
                        {{ $ticket->replies }}
                    </td>
                    <td>
                        {{ $ticket->owner->username }}
                    </td>
                    <td>
                        {{ date("D, F d Y",strtotime($ticket->updated_at)) }} <br> {{ date("g:i a",strtotime($ticket->updated_at)) }}
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@stop
