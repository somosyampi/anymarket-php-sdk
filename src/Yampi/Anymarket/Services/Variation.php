<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Contracts\VariationInterface;

class Variation extends BaseRequest implements VariationInterface
{
    public function __construct(Anymarket $anymarket, $http)
    {
        parent::__construct($anymarket, 'variations', $http);
    }
}
