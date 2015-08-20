<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoicesCreateWorksTest extends TestCase{

    use DatabaseTransactions;

    public function testCreateWorks()
    {
        $user = factory(SimpleLance\User::class)->create();

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/')
            ->see('<h1>Admin Dashboard</h1>');

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/invoices/create')
            ->see('<h4>Create New Invoice</h4>')
            ->type('2005-06-07', 'due')
            ->select('1', 'owner_id') // admin value
            ->select('1', 'status_id') // open value
            ->press('Create')
            ->see('<h1>Invoices</h1>')
            ->dontSee('Whoops');
    }
}
