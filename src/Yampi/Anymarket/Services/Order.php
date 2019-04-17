<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Contracts\OrderInterface;
use Yampi\Anymarket\Anymarket;

class Order extends BaseRequest implements OrderInterface
{
    public function __construct(Anymarket $anymarket)
    {
        parent::__construct($anymarket, 'orders');
    }

    public function updateStatus($id, $params)
    {
        $url = sprintf('%s/%s/%s', $this->anymarket->getEndpoint(), $this->service, $id);

        return $this->setParams($params)->sendRequest('PUT', $url);
    }

    public function feed()
    {
        $url = sprintf('%s/%s/feeds', $this->anymarket->getEndpoint(), $this->service);

        return $this->sendRequest('GET', $url);
    }

    public function feedUpdate($id, $token)
    {
        $url = sprintf('%s/%s/feeds/%s', $this->anymarket->getEndpoint(), $this->service, $id);

        $params = [
            'token' => $token
        ];

        return $this->setParams($params)->sendRequest('PUT', $url);
    }

    public function find($id)
    {
        throw new AnymarketException('Request method update not supported', 500);
    }

    public function create($params)
    {
        throw new AnymarketException('Request method create not supported', 500);
    }
}