@extends('layouts.default')

@section('content')
    <h1>Priorities</h1>
    <button class="btn btn-primary" onClick="location.href='{{ URL::action('PrioritiesController@create') }}'">New Priority</button>
    <table class="table table-striped table-hover">
        <thead>
        <th>Title</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <tbody>
        @foreach ($priorities as $priority)
            <tr>
                <td>
                    {{ $priority->title }}
                </td>
                <td>
                    <button class="btn btn-primary" onClick="location.href='{{ action('PrioritiesController@edit', array($priority->id)) }}'">Edit</button>
                </td>
                <td>
                    {{ Form::open(array(
                         'action' => array('PrioritiesController@destroy', $priority->id),
                         'method' => 'delete',
                         'class' => $priority->id . '-delete',
                         'id' => $priority->id . '-delete',
                         'name' => $priority->id . '-delete',
                         'role' => ''
                         )) }}

                    {{ Form::submit('Delete', array('class' => 'btn btn-danger'))}}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

