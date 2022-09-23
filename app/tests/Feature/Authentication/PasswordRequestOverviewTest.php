<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Authentication;

use App\Models\Authentication\PasswordRequest;
use Tests\TestCase;

class PasswordRequestOverviewTest extends TestCase
{
    /** @test */
    public function retrieve_all_data()
    {
        $response = $this
            ->getJson('/authentication/password-requests/florence@projet-eglise.fr', ['Authorization' => "Bearer {$this->adminToken()}"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => [[
                    'expiration',
                    'is_used',
                    'link',
                ]],
            ]);

        $expected = PasswordRequest::where('user_id', 1)->get()->count();
        $this->assertCount($expected, json_decode($response->getContent(), true)['data']);
    }
}
