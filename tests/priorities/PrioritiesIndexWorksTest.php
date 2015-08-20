<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PrioritiesIndexWorksTest extends TestCase{

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
            ->visit('/priorities')
            ->see('<h1>Priorities</h1>')
            ->see('<th>Title</th>')
            ->see('<th>Edit</th>')
            ->see('<th>Delete</th>')
            ->dontSee('Whoops');
    }
}
