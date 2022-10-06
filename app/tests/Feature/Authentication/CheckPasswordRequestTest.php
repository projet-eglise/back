<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Authentication;

use Tests\Feature\Authentication\AuthenticationTestCase;

class CheckPasswordRequestTest extends AuthenticationTestCase
{
    /** @test */
    public function when_the_request_is_not_expired_and_not_used()
    {
        $this
            ->getJson('/authentication/check-password-request/bbb')
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data',
            ]);
    }

    /** @test */
    public function when_the_request_is_expired_and_not_used()
    {
        $this
            ->getJson('/authentication/check-password-request/ccc')
            ->assertStatus(410)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }

    /** @test */
    public function when_the_request_is_not_expired_and_used()
    {
        $this
            ->getJson('/authentication/check-password-request/aaa')
            ->assertStatus(410)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }

    /** @test */
    public function when_the_request_is_expired_and_used()
    {
        $this
            ->getJson('/authentication/check-password-request/ddd')
            ->assertStatus(410)
            ->assertJsonStructure([
                'code',
                'message',
                'error',
            ]);
    }
}
