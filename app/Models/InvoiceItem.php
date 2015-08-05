<?php

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id', 'name', 'price', 'quantity', 'total'];
}
