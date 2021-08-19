<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BackendUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
   /* public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/


    public function test_admin_user_backend(){
        $response = $this->get('/admin/backend-user');
        $response->assertStatus(302);
    }
}
