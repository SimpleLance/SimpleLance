<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoicesShowWorksTest extends TestCase{

    use DatabaseTransactions;

    public function testShowWorks()
    {
        $user = factory(SimpleLance\User::class)->create();

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/')
            ->see('<h1>Admin Dashboard</h1>');

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/invoices/2')
            ->see('<h2>Invoice # 2</h2>')
            ->see('<strong>Due date:</strong>')
            ->see('<strong>Status:</strong>')
            ->see('<strong>Billed To:</strong>')
            ->see('<strong>Created date:</strong>')
            ->dontSee('Whoops');
    }
}
