<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectCreateWorksTest extends TestCase{

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
            ->visit('/projects/create')
            ->see('<h4>Create New Project</h4>')
            ->type('New Test Project', 'title')
            ->type('New Test Project Description', 'description')
            ->press('Create')
            ->see('<h1>Current Projects</h1>')
            ->dontSee('Whoops');
    }
}
