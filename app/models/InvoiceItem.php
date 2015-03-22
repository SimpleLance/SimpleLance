<?php

class InvoiceItem extends \Eloquent {
    protected $fillable = ['invoice_id', 'name', 'price', 'quantity', 'total'];

}