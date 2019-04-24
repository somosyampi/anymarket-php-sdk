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

    public static function sandbox()
    {
        return new self('http://sandbox-api.anymarket.com.br/v2');
    }

    public static function production()
    {
        return new self('http://api.anymarket.com.br/v2');
    }
}
