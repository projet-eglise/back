<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Authentication;

use Src\Domain\Authentication\JwtToken;
use Tests\TestCase;

class UpdatePasswordTest extends TestCase
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
