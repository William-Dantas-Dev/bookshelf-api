<?php

namespace Tests\Unit\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_success()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/v1/register', $data);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'message',
            'user' => [
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                'token',
            ],
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);
    }

    public function test_register_invalid_data_missing_name()
    {
        $data = [
            'email' => 'test@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/v1/register', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['name']);
    }

    public function test_register_invalid_data_missing_email()
    {
        $data = [
            'name' => 'Test User',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/v1/register', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['email']);
    }

    public function test_register_invalid_data_invalid_email_format()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/v1/register', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['email']);
    }

    public function test_register_email_already_exists()
    {
        \App\Models\User::create([
            'name' => 'Existing User',
            'email' => 'test@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $data = [
            'name' => 'New User',
            'email' => 'test@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/v1/register', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['email']);
    }

    public function test_register_invalid_data_missing_password()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/v1/register', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['password']);
    }

    public function test_register_invalid_data_passwords_do_not_match()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'differentpassword',
        ];

        $response = $this->postJson('/api/v1/register', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['password']);
    }

    public function test_register_password_too_short()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'shortpassword@gmail.com',
            'password' => 'short',
            'password_confirmation' => 'short',
        ];

        $response = $this->postJson('/api/v1/register', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['password']);
    }
}
