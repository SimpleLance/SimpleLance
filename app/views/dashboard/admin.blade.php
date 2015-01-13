@extends('layouts.default')

@section('content')
    Admin Dashboard

    Open Tickets: {{ count($openTickets) }} / In Progress Tickets: {{ count($inProgressTickets) }} <br />
    Open Projects: {{ count($openProjects) }} / In Progress Projects: {{ count($inProgressProjects) }} <br />
    Count of number of open invoices, also including total $ amount for all open invoices <br />
    Count of number of overdue invoices, also including total $ amount for all overdue invoices <br />
@stop

