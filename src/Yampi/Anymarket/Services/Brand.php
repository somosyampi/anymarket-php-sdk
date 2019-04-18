<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Contracts\BrandInterface;

class Brand extends BaseRequest implements BrandInterface
{
    public function __construct(Anymarket $anymarket, $http)
    {
        parent::__construct($anymarket, 'brands', $http);
    }
}
