<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

define('LARAVEL_START', microtime(true));

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    protected function setUp(array $class = ['Database\\Seeders\\DatabaseSeeder']): void
    {
        parent::setUp();
        $this->seed($class);
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
