<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectShowWorksTest extends TestCase{

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
            ->visit('/projects/2')
            ->see('<h4>Project</h4>')
            ->see('<strong>Title</strong>')
            ->see('<strong>Description</strong>')
            ->see('<strong>Status</strong>')
            ->see('<strong>Owner</strong>')
            ->see('Project created')
            ->see('Last Updated')
            ->dontSee('Whoops');
    }
}
