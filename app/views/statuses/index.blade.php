@extends('layouts.default')

@section('content')
    <h1>Statuses</h1>
    <button id="new" class="btn btn-primary" onClick="location.href='{{ URL::action('StatusesController@create') }}'">New Status</button>
    <table class="table table-striped table-hover">
        <thead>
        <th>Title</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <tbody>
        @foreach ($statuses as $status)
            <tr>
                <td>
                    {{ $status->title }}
                </td>
                <td>
                    <button id="edit-{{ $status->id }}" class="btn btn-primary" onClick="location.href='{{ action('StatusesController@edit', array($status->id)) }}'">Edit</button>
                </td>
                <td>
                    {{ Form::open(array(
                         'action' => array('StatusesController@destroy', $status->id),
                         'method' => 'delete',
                         'class' => $status->id . '-delete',
                         'id' => $status->id . '-delete',
                         'name' => $status->id . '-delete',
                         'role' => ''
                         )) }}

                    {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'id' => 'delete-' . $status->id])}}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

