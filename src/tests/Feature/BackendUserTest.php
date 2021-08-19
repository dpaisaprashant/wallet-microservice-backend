<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
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
    use DatabaseTransactions;
   /* public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/

    /** @test */
    public function admin_user_backend_view_from_the_database(){
        $response = $this->get('/admin/backend-user')->assertRedirect('/admin/login');
    }
}
