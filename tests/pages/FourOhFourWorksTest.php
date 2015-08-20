<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FourOhFourWorksTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test404PageWorks()
    {
        $response = $this->call('GET', '/some/bad/url/that/will/never/exist');

        $this->assertEquals(404, $response->status());
    }
}
