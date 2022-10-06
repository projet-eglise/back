<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Authentication;

use Src\Domain\Authentication\JwtToken;
use Tests\Feature\Authentication\AuthenticationTestCase;

class TokenLoginTest extends AuthenticationTestCase
{
    /** @test */
    public function admin_token_content()
    {
        $response = $this
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

        $token = new JwtToken(json_decode($response->getContent())->data->token);

        $this->assertTrue($token->hasField('isAdmin'));
        $this->assertTrue($token->hasField('exp'));
        $this->assertTrue($token->hasField('uuid'));
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
            ->assertJsonStructure([
                'code',
                'message',
                'data' => ['token']
            ]);

        $token = new JwtToken(json_decode($response->getContent())->data->token);

        $this->assertTrue($token->hasField('isAdmin'));
        $this->assertTrue($token->hasField('exp'));
        $this->assertTrue($token->hasField('uuid'));
        $this->assertTrue($token->hasAFieldThatIs('isAdmin', false));
    }
}
