<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Contracts\SkuInterface;
use Yampi\Anymarket\Anymarket;

class Sku extends BaseRequest implements SkuInterface
{
    public function __construct(Anymarket $anymarket)
    {  
        parent::__construct($anymarket, 'skus');
    }

    public function get($productId)
    {
        $url = sprintf('%s/products/%s/%s', $this->anymarket->getEndpoint(), $productId, $this->service);

        return $this->sendRequest('GET', $url);
    }

    public function find($productId, $id)
    {
        $url = sprintf('%s/products/%s/%s/%s', $this->anymarket->getEndpoint(), $productId, $this->service, $id);
        
    }

    public function create($productId, array $params)
    {
        $url = sprintf('%s/products/%s/%s', $this->anymarket->getEndpoint(), $productId, $this->service);
        
    }

    public function update($productId, $id, $params)
    {
        $url = sprintf('%s/products/%s/%s/%s', $this->anymarket->getEndpoint(), $productId, $this->service, $id);
        
    }

    public function delete($id)
    {
        throw new AnymarketException('Request method DELETE not supported', 500);        
    }
}