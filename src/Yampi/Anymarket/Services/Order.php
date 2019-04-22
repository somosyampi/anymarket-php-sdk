<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Contracts\OrderInterface;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Exceptions\AnymarketException;

class Order extends BaseRequest implements OrderInterface
{
    public function __construct(Anymarket $anymarket, $http)
    {
        parent::__construct($anymarket, 'orders', $http);
    }

    public function getWithFilter($status, $createdAfter = null, $offset = 0, $limit = 50)
    {
        $url = sprintf('%s/%s?offset=%s&limit=%s&status=%s', $this->anymarket->getEndpoint(), $this->service, $offset, $limit, $status);

        $url = $createdAfter ? $url.sprintf('&createdAfter=%s', $createdAfter) : $url;

        return $this->sendRequest('GET', $url);
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

    public function update($id, array $params)
    {
        throw new AnymarketException('Request method update not supported', 500);
    }

    public function create(array $params)
    {
        throw new AnymarketException('Request method create not supported', 500);
    }

    public function delete($id)
    {
        throw new AnymarketException('Request method delete not supported', 500);
    }
}
