@extends('layouts.default')

@section('content')
    <h1>Invoices</h1>

    <table class="table table-striped table-hover">
        <thead>
        <th>Title</th>
        <th>Due Date</th>
        <th>Status</th>
        <th>Owner</th>
        <th>Amount</th>
        </thead>
        <tbody>
        @foreach ($invoices as $invoice)
            @if (Sentry::inGroup(Sentry::findGroupByName('Admins')) || $invoice->owner_id == Sentry::getUser()->id)
                <tr>
                    <td>
                        <a href="{{ action('InvoicesController@show', array($invoice->id)) }}">
                            {{ $invoice->title }}
                        </a>
                    </td>
                    <td>
                        {{ date("F d Y",strtotime($invoice->due)) }}
                    </td>
                    <td>
                        {{ $invoice->status->title }}
                    </td>
                    <td>
                        {{ $invoice->owner->username }}
                    </td>
                    <td>
                        {{ $invoice->amount }}
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@stop