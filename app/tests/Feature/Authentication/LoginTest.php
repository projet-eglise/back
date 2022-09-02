<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Authentication;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function login_with_a_valid_password()
    {
        $this
            ->postJson('/authentication/login', [
                'email' => 'timothe@projet-eglise.fr',
                'password' => 'password',
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => ['token']
            ]);
    }

    /** @test */
    public function login_with_an_invalid_password()
    {
        $this
            ->postJson('/authentication/login', [
                'email' => 'timothe@projet-eglise.fr',
                'password' => 'root',
            ])
            ->assertStatus(401)
            ->assertJson([
                'code' => 401,
                'message' => 'Invalid credentials',
            ]);
    }

    /** @test */
    public function login_with_an_invalid_email()
    {
        $this
            ->postJson('/authentication/login', [
                'email' => 'timothe@projet-eglise.com',
                'password' => 'password',
            ])
            ->assertStatus(401)
            ->assertJson([
                'code' => 401,
                'message' => 'Invalid credentials',
            ]);
    }
}
