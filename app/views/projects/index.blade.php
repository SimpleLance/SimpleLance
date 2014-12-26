@extends('layouts.default')

@section('content')
    @if (Sentry::check())
        <div class="row col-md-9 col-md-offset-1">
            <h2>Current Open Projects</h2>
            <br>
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Owner</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    @if (Sentry::inGroup(Sentry::findGroupByName('Admins')) || $project->owner_id == Sentry::getUser()->id)
                        <tr>
                            <td><a href="{{ action('ProjectsController@show', array($project->id)) }}">
                                    {{ $project->title }}
                                </a></td>
                            <td>{{ $project->description }}</td>
                            <td>{{ $project->owner->username }}</td>
                            <td>{{ $project->status->title }}</td>
                            <td>{{ date('jS F Y', strtotime($project->updated_at)) }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@stop

