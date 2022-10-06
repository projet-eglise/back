<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Authentication;

use Tests\Feature\Authentication\AuthenticationTestCase;

class AdminLoginTest extends AuthenticationTestCase
{
    /** @test */
    public function login_with_a_valid_admin_credentials()
    {
        $this
            ->postJson('/authentication/admin/login', [
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
    public function login_with_invalid_admin_credentials()
    {
        $this
            ->postJson('/authentication/admin/login', [
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
