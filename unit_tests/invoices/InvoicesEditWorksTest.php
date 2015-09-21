<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoicesEditWorksTest extends TestCase{

    use DatabaseTransactions;

    public function testEditWorks()
    {
        $user = factory(SimpleLance\User::class)->create();

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/')
            ->see('<h1>Admin Dashboard</h1>');

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/invoices/2/edit')
            ->see('<h4>Edit Invoice</h4>')
            ->type('2004-06-07', 'due')
            ->select('1', 'owner_id') // admin value
            ->select('1', 'status_id') // open value
            ->press('Submit Changes')
            ->see('<h1>Invoices</h1>')
            ->dontSee('Whoops');
    }
}
