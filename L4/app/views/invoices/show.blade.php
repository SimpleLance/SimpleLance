@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice # {{ $invoice->id }}</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        {{ $invoice->owner->first_name.' '.$invoice->owner->last_name }}<br>
                        {{ $invoice->owner->address }}<br>
                        {{ $invoice->owner->city.', '.$invoice->owner->post_code }}<br>
                        {{ $invoice->owner->country }}
                    </address>
                </div>
                <div class="form-group col-xs-4">
                    <strong>Created date:</strong><br>
                    {{ $invoice->created_at->format('Y-m-d') }}
                </div>
                <div class="form-group col-xs-4">
                    <strong>Due date:</strong><br>
                    {{ $invoice->due }}
                </div>
                <div class="form-group col-xs-4">
                    <strong>Status:</strong><br>
                    {{ $invoice->status->title }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <p><em>Invoice created: {{ date("D, F d Y",strtotime($invoice->created_at)) }}</em></p>
            <p><em>Last Updated: {{ date("D, F d Y",strtotime($invoice->updated_at)) }} at {{ date("g:i a",strtotime($invoice->updated_at)) }}</em></p>
            <button id="edit-{{ $invoice->id }}" class="btn btn-primary" onClick="location.href='{{ action('InvoicesController@edit', array($invoice->id)) }}'">Edit Invoice</button>
        </div>
        <div class="col-md-2">
            {{ Form::open(array(
                 'action' => array('InvoicesController@destroy', $invoice->id),
                 'method' => 'delete',
                 'class' => $invoice->id . '-delete',
                 'id' => $invoice->id . '-delete',
                 'name' => $invoice->id . '-delete',
                 'role' => ''
                 )) }}

            {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'id' => 'delete-' . $invoice->id])}}
            {{ Form::close() }}
        </div>
    </div>

    <div class="col-md-2">
        {{ Form::open(array(
             'action' => array('InvoicesController@destroy', $invoice->id),
             'method' => 'delete',
             'class' => $invoice->id . '-delete',
             'id' => $invoice->id . '-delete',
             'name' => $invoice->id . '-delete',
             'role' => ''
             )) }}

        {{ Form::submit('Delete Invoice', ['class' => 'btn btn-danger', 'id' => 'delete-' . $invoice->id])}}
        {{ Form::close() }}
        <a href="/invoices{{ $invoice->id }}/send"  class="btn btn-primary">Send Invoice</a>
        <button id="edit-{{ $invoice->id }}" class="btn btn-primary" onClick="location.href='{{ action('InvoicesController@edit', array($invoice->id)) }}'">Edit Invoice</button>
    </div>
@stop