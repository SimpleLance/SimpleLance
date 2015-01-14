@extends('layouts.default')

@section('content')
    <h1>Admin Dashboard</h1>

    <h3>Support Tickets</h3>
    Open Tickets: {{ count($data['openTickets']) }} /
    In Progress Tickets: {{ count($data['inProgressTickets']) }} <br />

    <h3>Projects</h3>
    Open Projects: {{ count($data['openProjects']) }} /
    In Progress Projects: {{ count($data['inProgressProjects']) }} <br />

    <h3>Invoices:</h3>
    Open Invoices: {{ count($data['openInvoices']) }} /
    Total Open Amount: {{ $data['openInvoicesAmount'] }}<br />

    Overdue Invoices: {{ count($data['overdueInvoices']) }} /
    Total Overdue Amount: {{ $data['overdueInvoicesAmount'] }}<br />
@stop

