<?php

namespace Yampi\Anymarket\Exceptions;

use Exception;

class AnymarketValidationException extends Exception
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}