<?php

namespace Yampi\Anymarket;

class Anymarket
{
    protected $token;

    public function __construct($token)
    {   
        $this->token = $token;
    }

}