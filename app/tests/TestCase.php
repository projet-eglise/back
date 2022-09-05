<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    protected function adminToken(string $email = "timothe@projet-eglise.fr", string $password = "password"): string
    {
        $response = $this
            ->postJson('/authentication/admin/login', [
                'email' => $email,
                'password' => $password,
            ]);

        return json_decode($response->getContent())->data->token;
    }

    protected function userToken(string $email = "timothe@projet-eglise.fr", string $password = "password"): string
    {
        $response = $this
            ->postJson('/authentication/login', [
                'email' => $email,
                'password' => $password,
            ]);

        return json_decode($response->getContent())->data->token;
    }
}
