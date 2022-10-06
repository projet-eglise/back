<?php

namespace Tests\Feature\ChurchHumanResources;

use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(array $class = ['Database\\Seeders\\AuthenticationSeeder', 'Database\\Seeders\\ChurchHumanResourcesSeeder']): void
    {
        parent::setUp($class);
    }
}
