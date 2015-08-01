<?php
use SimpleLance\User;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class InvoiceItem extends Model {
    protected $fillable = ['invoice_id', 'name', 'price', 'quantity', 'total'];

}