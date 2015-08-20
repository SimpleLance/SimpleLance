<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminCanLoginTest extends TestCase{

    use DatabaseTransactions;

    public function testAdminCanLogin()
    {
        $this->visit('/auth/login')
            ->see('<div class="panel-heading">Login</div>')
            ->type('admin@admin.com', 'email')
            ->type('simplelance', 'password')
            ->press('Login')
            ->dontSee('Whoops');

        $this->visit('/dashboard')
            ->see('<h1>Admin Dashboard</h1>')
            ->dontSee('Whoops');
    }
}
