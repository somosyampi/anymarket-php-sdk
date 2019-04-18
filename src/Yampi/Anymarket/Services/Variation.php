<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Services\BaseRequest;
use Yampi\Anymarket\Contracts\VariationInterface;
use Yampi\Anymarket\Anymarket;

class Variation extends BaseRequest implements VariationInterface
{
    public function __construct(Anymarket $anymarket)
    {  
        parent::__construct($anymarket, 'variations');   
    }
}