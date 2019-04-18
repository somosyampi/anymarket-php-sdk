<?php

namespace Yampi\Anymarket\Exceptions;

use Exception;

class AnymarketException extends Exception
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
