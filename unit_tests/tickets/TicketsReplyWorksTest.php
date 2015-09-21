<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketsReplyWorksTest extends TestCase{

    use DatabaseTransactions;

    public function testReplyWorks()
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
            ->type('This is a test reply', 'content')
            ->press('Submit Reply')
            ->visit('/tickets/1')
            ->see('This is a test reply')
            ->dontSee('Whoops');
    }
}
