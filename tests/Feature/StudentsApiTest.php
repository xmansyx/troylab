<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_data_returned_unauthenticated()
    {

       $this->getJson('/api/students')->assertUnauthorized();

    }
    public function test_if_data_returned_correct()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->getJson('/api/students');
        
       $response->assertOk()
            ->assertJson([
                'data' => [],
            ]);

    }

    // public function test_if_user_email_is_not_wrong_then_it_returns_an_error()
    // {
    //     $this->postJson('/api/login',[
    //         'email' => 'test@test.com',
    //         'password' => 'password'
    //     ])->assertUnauthorized();
    // }

    // public function test_if_password_is_incorrect_then_it_returns_an_error()
    // {
    //     $user = User::factory()->create();

    //     $this->postJson('/api/login',[
    //         'email' => $user->email,
    //         'password' => 'random'
    //     ])->assertUnauthorized();
    // }
}