<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanLoginTest extends TestCase{

    use DatabaseTransactions;

    public function testUserCanLogin()
    {
        $this->visit('/auth/login')
            ->see('<div class="panel-heading">Login</div>')
            ->type('user@user.com', 'email')
            ->type('simplelance', 'password')
            ->press('Login')
            ->dontSee('Whoops');

        $this->visit('/dashboard')
            ->see('<h1>User Dashboard</h1>')
            ->dontSee('Whoops');
    }
}
