<?php

namespace Tests;

use Yampi\Anymarket\Contracts\EnvironmentInterface;
use Yampi\Anymarket\Services\Environment;

class EnvironmentTest extends TestCase
{
    public function test_environment_sandbox()
    {
        $this->assertInstanceOf(EnvironmentInterface::class, Environment::sandbox());
    }

    public function test_environment_production()
    {
        $this->assertInstanceOf(EnvironmentInterface::class, Environment::production());
    }
}
