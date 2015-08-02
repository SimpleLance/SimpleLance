<?php namespace SimpleLance\Http\Controllers;

use Ticket;
use Project;
use Invoice;
use Illuminate\Support\Facades\View;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class DashboardController extends Controller
{
    protected $ticket;
    protected $project;
    protected $invoice;

    public function __construct(
        Ticket $ticket,
        Project $project,
        Invoice $invoice
    ) {
        $this->middleware('Sentinel\Middleware\SentryAuth');

        $this->ticket = $ticket;
        $this->project = $project;
        $this->invoice = $invoice;
    }

    public function index()
    {
        if (Sentry::inGroup(Sentry::findGroupByName('Admins'))) {
            $data['openTickets'] = $this->ticket->getOpenTickets();
            $data['inProgressTickets'] = $this->ticket->getInProgressTickets();
            $data['openProjects'] = $this->project->getOpenProjects();
            $data['inProgressProjects'] = $this->project->getInProgressProjects();
            $data['openInvoices'] = $this->invoice->getOpenInvoices();
            $data['openInvoicesAmount'] = $this->invoice->getOpenInvoicesTotalAmount();
            $data['overdueInvoices'] = $this->invoice->getOverdueInvoices();
            $data['overdueInvoicesAmount'] = $this->invoice->getOverdueInvoicesTotalAmount();

            return View::make('dashboard.admin')->with('data', $data);
        } else {
            $data['openTickets'] = $this->ticket->getOpenTicketsByUser();
            $data['inProgressTickets'] = $this->ticket->getInProgressTicketsByUser();
            $data['openProjects'] = $this->project->getOpenProjectsByUser();
            $data['inProgressProjects'] = $this->project->getInProgressProjectsByUser();
            $data['openInvoices'] = $this->invoice->getOpenInvoicesByUser();
            $data['openInvoicesAmount'] = $this->invoice->getOpenInvoicesTotalAmountByUser();
            $data['overdueInvoices'] = $this->invoice->getOverdueInvoicesByUser();
            $data['overdueInvoicesAmount'] = $this->invoice->getOverdueInvoicesTotalAmountByUser();

            return View::make('dashboard.user')->with('data', $data);
        }
    }
}
