<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationAdminLoginTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function login_with_a_valid_admin_credentials()
    {
        $this
            ->postJson('/admin/authentication/login', [
                'email' => 'timothe@projet-eglise.fr',
                'password' => 'password',
            ])
            ->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    /** @test */
    public function login_with_invalid_admin_credentials()
    {
        $this
            ->postJson('/admin/authentication/login', [
                'email' => 'timothe@hofmann.fr',
                'password' => 'password',
            ])
            ->assertStatus(403)
            ->assertJson([
                'code' => 403,
                'message' => "You are not an administrator.",
            ]);
    }
}
