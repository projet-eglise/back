<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Nette\NotImplementedException;
use Src\Domain\Authentication\JwtToken;
use Tests\TestCase;

class AuthenticationTokenLoginTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function admin_token_content()
    {
        $response = $this
            ->postJson('/admin/authentication/login', [
                'email' => 'timothe@projet-eglise.fr',
                'password' => 'password',
            ])
            ->assertStatus(200)
            ->assertJsonStructure(['token']);

        $token = new JwtToken(json_decode($response->getContent())->token);

        $this->assertTrue($token->hasField('isAdmin'));
        $this->assertTrue($token->hasAFieldThatIs('isAdmin', true));
    }

    /** @test */
    public function user_token_content()
    {
        $response = $this
            ->postJson('/authentication/login', [
                'email' => 'timothe@hofmann.fr',
                'password' => 'password',
            ])
            ->assertStatus(200)
            ->assertJsonStructure(['token']);

        $token = new JwtToken(json_decode($response->getContent())->token);

        $this->assertTrue($token->hasField('isAdmin'));
        $this->assertTrue($token->hasAFieldThatIs('isAdmin', false));
    }
}
