<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectEditWorksTest extends TestCase{

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
            ->visit('/projects/2/edit')
            ->see('<h4>Edit Project</h4>')
            ->type('Test Project Updated', 'title')
            ->type('Test Project Description Updated', 'description')
            ->press('Submit Changes')
            ->visit('/projects')
            ->see('Test Project Updated')
            ->dontSee('Whoops');
    }
}
