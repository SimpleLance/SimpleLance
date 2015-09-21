<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketsShowWorksTest extends TestCase{

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
            ->visit('/tickets/1')
            ->see('<h4>Support Ticket</h4>')
            ->see('<strong>Subject</strong>')
            ->see('Ticket opened by')
            ->see('<strong>Priority</strong>')
            ->see('<strong>Owner</strong>')
            ->see('<strong>Ticket created</strong>')
            ->see('<strong>Last Updated</strong>')
            ->dontSee('Whoops');
    }
}
