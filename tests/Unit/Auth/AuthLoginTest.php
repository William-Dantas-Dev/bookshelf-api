<?php

namespace Tests\Unit\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_success()
    {
        $user = User::factory()->create([
            'email' => 'william@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => 'william@gmail.com',
            'password' => 'password123',
        ]);

        // Valida o retorno
        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => ['id', 'name', 'email'],
                'token',
            ]);
    }

    public function test_login_failure_with_incorrect_password()
    {
        $user = User::factory()->create([
            'email' => 'william@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => 'william@gmail.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);
    }

    public function test_login_failure_with_unregistered_email()
    {
        $response = $this->postJson('/api/v1/login', [
            'email' => 'william@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);
    }

    public function test_login_failure_with_missing_email()
    {
        $response = $this->postJson('/api/v1/login', [
            'password' => 'password123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_login_failure_with_missing_password()
    {
        $response = $this->postJson('/api/v1/login', [
            'email' => 'william@gmail.com',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    public function test_login_failure_with_invalid_email_format()
    {
        $response = $this->postJson('/api/v1/login', [
            'email' => 'invalid-email',
            'password' => 'password123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_login_password_too_short()
    {
        $data = [
            'email' => 'shortpassword@gmail.com',
            'password' => 'short',
        ];

        $response = $this->postJson('/api/v1/login', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['password']);
    }
}
