<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoicesIndexWorksTest extends TestCase{

    use DatabaseTransactions;

    public function testIndexWorks()
    {
        $user = factory(SimpleLance\User::class)->create();

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/')
            ->see('<h1>Admin Dashboard</h1>');

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/invoices')
            ->see('<h1>Invoices</h1>')
            ->see('<th>Due Date</th>')
            ->see('<th>Status</th>')
            ->see('<th>Owner</th>')
            ->see('<th>Amount</th>')
            ->dontSee('Whoops');
    }
}
