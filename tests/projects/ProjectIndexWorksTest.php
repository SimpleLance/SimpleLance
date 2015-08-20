<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectIndexWorksTest extends TestCase{

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
            ->visit('/projects')
            ->see('<h1>Current Projects</h1>')
            ->see('<th>Title</th>')
            ->see('<th>Updated At</th>')
            ->see('<th>Priority</th>')
            ->see('<th>Owner</th>')
            ->dontSee('Whoops');
    }
}
