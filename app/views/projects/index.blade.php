@extends('layouts.default')

@section('content')
    <h1>Current Projects</h1>
    <div class="statuses">
        @foreach($statuses as $status)
            <a class="btn btn-default"
               role="button"
               href="/projects/status/{{ $status }}">{{ $status }}</a>
        @endforeach
    </div>
    <table class="table table-striped table-hover">
        <thead>
        <th>Title</th>
        <th>Status</th>
        <th>Priority</th>
        <th>Owner</th>
        <th>Updated At</th>
        </thead>
        <tbody>
        @foreach ($projects as $project)
            @if (Sentry::inGroup(Sentry::findGroupByName('Admins')) || $project->owner_id == Sentry::getUser()->id)
                <tr>
                    <td style="vertical-align: middle;">
                        <a href="{{ action('ProjectsController@show', array($project->id)) }}">
                            {{ $project->title }}
                        </a>
                    </td>
                    <td>
                        {{ $project->status->title }}
                    </td>
                    <td>
                        {{ $project->priority->title }}
                    </td>
                    <td>
                        {{ $project->owner->username }}
                    </td>
                    <td>
                        {{ date("D, F d Y",strtotime($project->updated_at)) }} <br> {{ date("g:h a",strtotime($project->updated_at)) }}
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@stop

