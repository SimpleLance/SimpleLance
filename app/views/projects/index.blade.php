@extends('layouts.default')

@section('content')
    <h1>Current Projects</h1>

    <table class="table table-striped table-hover">
        <thead>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Owner</th>
        </thead>
        <tbody>
        @foreach ($projects as $project)
            @if (Sentry::inGroup(Sentry::findGroupByName('Admins')) || $project->owner_id == Sentry::getUser()->id)
                <tr>
                    <td>
                        <a href="{{ action('ProjectsController@show', array($project->id)) }}">
                            {{ $project->title }}
                        </a>
                    </td>
                    <td>
                        {{ $project->description }}
                    </td>
                    <td>
                        {{ $project->status->title }}
                    </td>
                    <td>
                        {{ $project->owner->username }}
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@stop

