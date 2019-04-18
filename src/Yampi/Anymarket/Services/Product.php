<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Contracts\ProductInterface;
use Yampi\Anymarket\Exceptions\AnymarketException;

class Product extends BaseRequest implements ProductInterface
{
    public function __construct(Anymarket $anymarket)
    {
        parent::__construct($anymarket, 'products');
    }

    public function delete($id)
    {
        throw new AnymarketException('Request method DELETE not supported', 500);
    }
}
