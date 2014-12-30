@extends('layouts.default')

@section('content')
    <h1>Support Tickets</h1>

    <table class="table table-striped table-hover">
        <thead>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Owner</th>
        </thead>
        <tbody>
        @foreach ($tickets as $ticket)
            @if (Sentry::inGroup(Sentry::findGroupByName('Admins')) || $ticket->owner_id == Sentry::getUser()->id)
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
                        {{ $ticket->status->title }}
                    </td>
                    <td>
                        {{ $ticket->owner->username }}
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@stop