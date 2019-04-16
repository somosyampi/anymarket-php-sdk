<?php

namespace Yampi\Anymarket\Services;

use GuzzleHttp\ClientInterface;
use Yampi\Anymarket\Anymarket;

class BaseRequest
{
    protected $http;

    protected $anymarket;

    protected $params;

    public function __construct(ClientInterface $http, Anymarket $anymarket)
    {
        $this->http = $http;
        $this->anymarket = $anymarket;
    }

    public function setParams(Array $value)
    {
        $this->params = $value;
        return $this;
    }

}