<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PrioritiesEditWorksTest extends TestCase{

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
            ->visit('/priorities/1/edit')
            ->see('<h4>Edit Priority</h4>')
            ->type('Test Priority Updated', 'title')
            ->press('Submit Changes')
            ->see('Test Priority Updated')
            ->dontSee('Whoops');
    }
}
