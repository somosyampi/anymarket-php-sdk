<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Contracts\SkuInterface;
use Yampi\Anymarket\Exceptions\AnymarketException;

class Sku extends BaseRequest implements SkuInterface
{
    protected $product;

    public function __construct(Anymarket $anymarket, $http)
    {
        parent::__construct($anymarket, 'skus', $http);
    }

    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    public function get($offset = 0, $limit = 50)
    {
        if (!$this->product) {
            throw new AnymarketException('É necessarios utilizar o setProduct para atribuir um produto !', 400);
        }

        $url = sprintf('%s/products/%s/%s', $this->anymarket->getEndpoint(), $this->product, $this->service);

        return $this->sendRequest('GET', $url);
    }

    public function find($id)
    {
        if (!$this->product) {
            throw new AnymarketException('É necessarios utilizar o setProduct para atribuir um produto !', 400);
        }

        $url = sprintf('%s/products/%s/%s/%s', $this->anymarket->getEndpoint(), $this->product, $this->service, $id);

        return $this->sendRequest('GET', $url);
    }

    public function create(array $params)
    {
        if (!$this->product) {
            throw new AnymarketException('É necessarios utilizar o setProduct para atribuir um produto !', 400);
        }

        $url = sprintf('%s/products/%s/%s', $this->anymarket->getEndpoint(), $this->product, $this->service);

        return $this->setParams($params)->sendRequest('POST', $url);
    }

    public function update($id, array $params)
    {
        if (!$this->product) {
            throw new AnymarketException('É necessarios utilizar o setProduct para atribuir um produto !', 400);
        }

        $url = sprintf('%s/products/%s/%s/%s', $this->anymarket->getEndpoint(), $this->product, $this->service, $id);

        return $this->setParams($params)->sendRequest('PUT', $url);
    }

    public function updateTitle($id, $title)
    {
        if (!$this->product) {
            throw new AnymarketException('É necessarios utilizar o setProduct para atribuir um produto !', 400);
        }

        $params = $this->find($id);
        $params['title'] = $title;

        return $this->update($id, $params);
    }

    public function updatePrice($id, $price, $sellPrice = null)
    {
        if (!$this->product) {
            throw new AnymarketException('É necessarios utilizar o setProduct para atribuir um produto !', 400);
        }

        $params = $this->find($id);
        $params['price'] = $price;

        !$sellPrice ?: $params['sellPrice'] = $sellPrice;

        return $this->update($id, $params);
    }

    public function delete($id)
    {
        throw new AnymarketException('Request method DELETE not supported', 500);
    }
}
