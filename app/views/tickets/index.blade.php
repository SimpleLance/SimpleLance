@extends('layouts.default')

@section('content')
    <h1>Support Tickets</h1>

    <table class="table table-striped table-hover">
        <thead>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Owner</th>
        </thead>
        <tbody>
        @foreach ($tickets as $ticket)
            <tr>
                <td>
                    <a href="{{ action('TicketsController@show', array($ticket->id)) }}">
                        {{ $ticket->title }}
                    </a>
                </td>
                <td>
                    {{ $ticket->description }}
                </td>
                <td>
                    {{ $ticket->priority->title }}
                </td>
                <td>
                    {{ $ticket->owner->username }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

