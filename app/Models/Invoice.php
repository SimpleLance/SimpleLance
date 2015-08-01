<?php

use SimpleLance\User;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class Invoice extends \Eloquent {
	protected $fillable = [
		'title',
		'due',
		'status_id',
		'amount',
		'owner_id'
	];

	public function owner() {

		return $this->belongsTo('SimpleLance\User');
	}

	public function status() {

		return $this->belongsTo('InvoiceStatus');
	}

	public function getOpenInvoices() {

		return Invoice::where('status_id', '=', '1')->get();
	}

	public function getOpenInvoicesTotalAmount() {
		$invoices = $this->getOpenInvoices();

		$totalAmount = 0;

		foreach ($invoices as $invoice) {
			$totalAmount = $totalAmount + $invoice->amount;
		}

		return $totalAmount;
	}

	public function getOverdueInvoices() {
		$invoices = $this->getOpenInvoices();
		$overdueInvoices = [];
		$today = date("Y-m-d");

		foreach ($invoices as $invoice) {
			if($invoice->due < $today){
				$overdueInvoices[] = $invoice;
			}
		}

		return $overdueInvoices;
	}

	public function getOverdueInvoicesTotalAmount() {
		$invoices = $this->getOverdueInvoices();

		$totalAmount = 0;

		foreach ($invoices as $invoice) {
			$totalAmount = $totalAmount + $invoice->amount;
		}

		return $totalAmount;
	}

	public function getOpenInvoicesByUser() {

		return Invoice::where('status_id', '=', '1')
			->where('owner_id', '=', Sentry::getUser()->id)
			->get();
	}

	public function getOpenInvoicesTotalAmountByUser() {
		$invoices = $this->getOpenInvoicesByUser();

		$totalAmount = 0;

		foreach ($invoices as $invoice) {
			$totalAmount = $totalAmount + $invoice->amount;
		}

		return $totalAmount;
	}

	public function getOverdueInvoicesByUser() {
		$invoices = $this->getOpenInvoicesByUser();
		$overdueInvoices = [];
		$today = date("Y-m-d");

		foreach ($invoices as $invoice) {
			if($invoice->due < $today){
				$overdueInvoices[] = $invoice;
			}
		}

		return $overdueInvoices;
	}

	public function getOverdueInvoicesTotalAmountByUser() {
		$invoices = $this->getOverdueInvoicesByUser();

		$totalAmount = 0;

		foreach ($invoices as $invoice) {
			$totalAmount = $totalAmount + $invoice->amount;
		}

		return $totalAmount;
	}

	public function item() {

		return $this->belongsTo('InvoiceItem');
	}
}