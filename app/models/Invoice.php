<?php

class Invoice extends \Eloquent {
	protected $fillable = [
		'title',
		'due',
		'status_id',
		'amount',
		'owner_id'
	];

	public function owner() {

		return $this->belongsTo('User');
	}

	public function status() {

		return $this->belongsTo('Status');
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
}