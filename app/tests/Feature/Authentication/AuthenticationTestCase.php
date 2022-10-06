<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;

abstract class AuthenticationTestCase extends TestCase
{
    protected function setUp(array $class = ['Database\\Seeders\\AuthenticationSeeder', 'Database\\Seeders\\ChurchHumanResourcesSeeder']): void
    {
        parent::setUp($class);
    }
}
