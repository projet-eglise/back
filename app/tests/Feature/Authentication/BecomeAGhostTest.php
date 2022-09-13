<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Authentication;

use Tests\TestCase;

class BecomeAGhostTest extends TestCase
{
    /** @test */
    public function become_a_ghost_with_valid_email()
    {
        $this
            ->getJson('/authentication/become-a-ghost/timothe@hofmann.fr', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => ['token']
            ]);
    }

    /** @test */
    public function become_a_ghost_with_invalid_email()
    {
        $this
            ->getJson('/authentication/become-a-ghost/timothe@homann.fr', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(422)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }


    /** @test */
    public function become_a_ghost_with_invalid_token()
    {
        $this
            ->getJson('/authentication/become-a-ghost/timothe@hofmann.fr', ['Authorization' => "Bearer {$this->userToken()}"])
            ->assertStatus(403)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }
}
