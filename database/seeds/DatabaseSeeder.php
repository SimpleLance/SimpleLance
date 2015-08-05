<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->call('PrioritiesTableSeeder');
        $this->call('StatusesTableSeeder');
        $this->call('ProjectsTableSeeder');
        $this->call('TicketsTableSeeder');
        $this->call('InvoicesTableSeeder');
        $this->call('InvoiceStatusesTableSeeder');
    }
}
