<?php

use Illuminate\Database\Seeder;

class InvoiceStatusesTableSeeder extends Seeder {

    public function run()
    {
        InvoiceStatus::create([
            'title' => 'Open'
        ]);
        InvoiceStatus::create([
            'title' => 'Overdue'
        ]);
        InvoiceStatus::create([
            'title' => 'Draft'
        ]);
        InvoiceStatus::create([
            'title' => 'Paid'
        ]);
        InvoiceStatus::create([
            'title' => 'Cancelled'
        ]);
    }

}