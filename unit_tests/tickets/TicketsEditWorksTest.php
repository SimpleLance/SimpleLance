<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketsEditWorksTest extends TestCase{

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
            ->visit('/tickets/1/edit')
            ->see('<h4>Edit Support Ticket</h4>')
            ->type('Test Ticket Updated', 'title')
            ->press('Submit Changes')
            ->see('Ticket Updated')
            ->dontSee('Whoops');
    }
}
