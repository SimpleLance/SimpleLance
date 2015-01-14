@extends('layouts.default')

@section('content')
    <h1>Admin Dashboard</h1>

    <h3>Support Tickets</h3>
    <p>
        Open Tickets: {{ count($data['openTickets']) }} /
        In Progress Tickets: {{ count($data['inProgressTickets']) }}
    </p>

    <h3>Projects</h3>
    <p>
        Open Projects: {{ count($data['openProjects']) }} /
        In Progress Projects: {{ count($data['inProgressProjects']) }}
    </p>

    <h3>Invoices:</h3>
    <p>
        Open Invoices: {{ count($data['openInvoices']) }} /
        Total Open Amount: {{ $data['openInvoicesAmount'] }}
    </p>
    <p>
        Overdue Invoices: {{ count($data['overdueInvoices']) }} /
        Total Overdue Amount: {{ $data['overdueInvoicesAmount'] }}
    </p>
@stop

