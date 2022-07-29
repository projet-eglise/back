<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationLoginTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function login_with_a_valid_password()
    {
        $this
            ->postJson('/authentication/login', [
                'email' => 'timothe@projet-eglise.fr',
                'password' => 'root',
            ])
            ->assertStatus(200);
    }

    /** @test */
    public function login_with_an_invalid_password()
    {
        $this
            ->postJson('/authentication/login', [
                'email' => 'timothe@projet-eglise.fr',
                'password' => 'rootroot',
            ])
            ->assertStatus(401)
            ->assertJson([
                'code' => 401,
                'error' => 'Invalid credentials',
            ]);
    }

    /** @test */
    public function login_with_an_invalid_email()
    {
        $this
            ->postJson('/authentication/login', [
                'email' => 'timothe@projet-eglise.com',
                'password' => 'root',
            ])
            ->assertStatus(401)
            ->assertJson([
                'code' => 401,
                'error' => 'Invalid credentials',
            ]);
    }
}
