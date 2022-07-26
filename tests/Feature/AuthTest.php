<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_login_with_email_and_password()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login',[
            'email' => $user->email,
            'password' => 'password'
        ])->assertOk();

        $this->assertArrayHasKey('token',$response->json());
    }

    public function test_if_user_email_is_not_available_then_it_return_error()
    {
        $this->postJson('/api/login',[
            'email' => 'test@test.com',
            'password' => 'password'
        ])->assertUnauthorized();
    }

    public function test_it_raise_error_if_password_is_incorrect()
    {
        $user = User::factory()->create();

        $this->postJson('/api/login',[
            'email' => $user->email,
            'password' => 'random'
        ])->assertUnauthorized();
    }
}