<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Contracts\StockInterface;

class Stock extends BaseRequest implements StockInterface
{
    public function __construct(Anymarket $anymarket)
    {
        parent::__construct($anymarket, 'stocks');
    }

    public function get($offset, $limit = 50)
    {
        throw new AnymarketException('Request method get not supported', 500);
    }

    public function find($id)
    {
        throw new AnymarketException('Request method find not supported', 500);
    }

    public function updatePrice($id, $price)
    {
        $url = sprintf('%s/%s', $this->anymarket->getEndpoint(), $this->service);

        $params = [
            [
                'id' => $id,
                'cost' => $price
            ]   
        ];

        return $this->setParams($params)->sendRequest('PUT', $url);
    }

    public function updateStockQuantity($id, $quantity)
    {
        $url = sprintf('%s/%s', $this->anymarket->getEndpoint(), $this->service);

        $params = [
            [
                'id' => $id,
                'quantity' => $quantity
            ]   
        ];

        return $this->setParams($params)->sendRequest('PUT', $url);
    }

    public function update($id, $params)
    {
        $url = sprintf('%s/%s', $this->anymarket->getEndpoint(), $this->service);

        $params = [
            $params
        ];

        return $this->setParams($params)->sendRequest('PUT', $url);
    }

    public function delete($id)
    {
        throw new AnymarketException('Request method DELETE not supported', 500);
    }
}