<?php

namespace Tests\Feature\Mailing;

use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(array $class = ['Database\\Seeders\\AuthenticationSeeder', 'Database\\Seeders\\MailingSeeder']): void
    {
        parent::setUp($class);
    }
}
