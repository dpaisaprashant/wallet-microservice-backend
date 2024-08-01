<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;

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


    public function test_view_backend_user_list(){
        $this->withoutExceptionHandling();
        $this->actingAs(factory(Admin::class)->create());
        $response = $this->get('/admin/backend-user')->assertOk();
    }

    public function test_post_backend_user_list(){
        $this->post('/admin/backend-user/create',[
            'name' => 'Rahul Shakya',
            'email' => 'rahulshakya123rs@gmail.com',
            'mobile_no' => '9860035972',
            'password' => 'password123'
        ]);

        $this->assertCount(1,Admin::all());
    }
}
