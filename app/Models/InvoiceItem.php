<?php
use SimpleLance\User;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class InvoiceItem extends \Eloquent
{
    protected $fillable = ['invoice_id', 'name', 'price', 'quantity', 'total'];
}
