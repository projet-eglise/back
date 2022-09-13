<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Authentication;

use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    /** @test */
    public function user_route_with_user_credentials()
    {
        $this
            ->getJson('/church-human-ressources/churches/joinable', ['Authorization' => "Bearer {$this->userToken('timothe@hofmann.fr')}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data',
            ]);
    }

    /** @test */
    public function user_route_with_admin_credentials()
    {
        $this
            ->getJson('/church-human-ressources/churches/joinable', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(403)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }

    /** @test */
    public function admin_route_with_admin_credentials()
    {
        $this
            ->getJson('/church-human-ressources/christians/all', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data',
            ]);
    }

    /** @test */
    public function admin_route_with_user_credentials()
    {
        $this
            ->getJson('/church-human-ressources/christians/all', ['Authorization' => "Bearer {$this->userToken('timothe@hofmann.fr')}"])
            ->assertStatus(403)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }
}
