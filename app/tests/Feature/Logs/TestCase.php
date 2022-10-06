<?php

namespace Tests\Feature\Logs;

use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(array $class = ['Database\\Seeders\\AuthenticationSeeder', 'Database\\Seeders\\LogsSeeder']): void
    {
        parent::setUp($class);
    }
}
