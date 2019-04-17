<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Contracts\SkuInterface;
use Yampi\Anymarket\Anymarket;

class Sku extends BaseRequest implements SkuInterface
{
    protected $product;

    public function __construct(Anymarket $anymarket)
    {  
        parent::__construct($anymarket, 'skus');
    }

    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }

    public function get($offset = 0, $limit = 50)
    {
        $url = sprintf('%s/products/%s/%s', $this->anymarket->getEndpoint(), $this->product, $this->service);

        return $this->sendRequest('GET', $url);
    }

    public function find($id)
    {
        $url = sprintf('%s/products/%s/%s/%s', $this->anymarket->getEndpoint(), $this->productId, $this->service, $id);

        return $this->sendRequest('GET', $url);
    }

    public function create(array $params)
    {
        $url = sprintf('%s/products/%s/%s', $this->anymarket->getEndpoint(), $this->productId, $this->service);
        
        return $this->setParams($params)->sendRequest('POST', $url);
    }

    public function update($id, $params)
    {
        $url = sprintf('%s/products/%s/%s/%s', $this->anymarket->getEndpoint(), $this->productId, $this->service, $id);

        return $this->setParams($params)->sendRequest('PUT', $url);
    }

    public function delete($id)
    {
        throw new AnymarketException('Request method DELETE not supported', 500);        
    }
}