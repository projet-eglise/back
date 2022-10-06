<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Authentication;

use Tests\Feature\Authentication\AuthenticationTestCase;

class UpdatePasswordTest extends AuthenticationTestCase
{
    /** @test */
    public function change_password()
    {
        $this
            ->postJson('/authentication/change-password/bbb', [
                'password' => '@Zertyu1p23addez',
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data',
            ]);

        $this
            ->postJson('/authentication/change-password/bbb', [
                'password' => '@Zertyu1p23addez123',
            ])
            ->assertStatus(410)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);

        $this
            ->postJson('/authentication/login', [
                'email' => 'florence@projet-eglise.fr',
                'password' => '@Zertyu1p23addez',
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => ['token']
            ]);
    }
}
