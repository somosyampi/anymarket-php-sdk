<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Contracts\EnvironmentInterface;

class Environment implements EnvironmentInterface
{
    protected $endpoint;

    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    static function sandbox()
    {
        return new Environment('http://sandbox-api.anymarket.com.br/v2');
    }

    static function production()
    {
        return new Environment('http://api.anymarket.com.br/v2');
    }
}
