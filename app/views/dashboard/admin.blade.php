@extends('layouts.default')

@section('content')
    Admin Dashboard

    Open Tickets: {{ count($openTickets) }} / In Progress Tickets: {{ count($inProgressTickets) }} <br />
    Count of number of open/in-progress projects (should show split of open/in-progress) <br />
    Count of number of open invoices, also including total $ amount for all open invoices <br />
    Count of number of overdue invoices, also including total $ amount for all overdue invoices <br />
@stop

