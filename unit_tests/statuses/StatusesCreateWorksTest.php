<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StatusesCreateWorksTest extends TestCase{

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
            ->visit('/statuses/create')
            ->see('<h4>Create New Status</h4>')
            ->type('Test Status', 'title')
            ->press('Create')
            ->see('<h1>Statuses</h1>')
            ->see('Test Status')
            ->dontSee('Whoops');
    }
}
