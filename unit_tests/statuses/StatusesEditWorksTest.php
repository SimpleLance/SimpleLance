<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StatusesEditWorksTest extends TestCase{

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
            ->visit('/statuses/1/edit')
            ->see('<h4>Edit Status</h4>')
            ->type('Test Status Updated', 'title')
            ->press('Submit Changes')
            ->see('Test Status Updated')
            ->dontSee('Whoops');
    }
}
