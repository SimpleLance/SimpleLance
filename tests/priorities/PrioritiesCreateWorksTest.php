<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PrioritiesCreateWorksTest extends TestCase{

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
            ->visit('/priorities/create')
            ->see('<h4>Create New Priority</h4>')
            ->type('Test Priority', 'title')
            ->press('Create')
            ->see('<h1>Priorities</h1>')
            ->see('Test Priority')
            ->dontSee('Whoops');
    }
}
