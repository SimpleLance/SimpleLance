@extends('layouts.default')

@section('content')
    <h1>Invoices</h1>

    <table class="table table-striped table-hover">
        <thead>
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
                            {{ date("F d Y",strtotime($invoice->due)) }}
                        </a>
                    </td>
                    <td>
                        {{ $invoice->status->title }}
                    </td>
                    <td>
                        {{ $invoice->owner->username }}
                    </td>
                    <td>
                        <a href="{{ action('InvoicesController@show', array($invoice->id)) }}">
                            {{ number_format($invoice->amount, 2, '.', ',') }}
                        </a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    {{ $invoices->links() }}
@stop