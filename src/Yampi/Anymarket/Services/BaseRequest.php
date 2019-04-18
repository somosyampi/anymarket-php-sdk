<?php

namespace Yampi\Anymarket\Services;

use GuzzleHttp\Client as Client;
use Yampi\Anymarket\Anymarket;
use GuzzleHttp\Exceptions\RequestException;
use Yampi\Anymarket\Exceptions\AnymarketValidationException;
use Yampi\Anymarket\Exceptions\AnymarketException;
use Yampi\Anymarket\Contracts\BaseRequestInterface;
use GuzzleHttp\Exception\ClientException;

abstract class BaseRequest implements BaseRequestInterface
{
    protected $params;

    protected $service;

    protected $http;

    public function __construct(Anymarket $anymarket, $service, $http)
    {
        $this->anymarket = $anymarket;
        $this->service = $service;
        $this->http = $http;
    }

    public function setParams(array $value)
    {
        $this->params = $value;
        return $this;
    }

    public function get($offset = 0, $limit = 50)
    {
        $url = sprintf('%s/%s?offset=%s&limit=%s', $this->anymarket->getEndpoint(), $this->service, $offset, $limit);

        return $this->sendRequest('GET', $url);
    }

    public function create(array $params)
    {
        $url = sprintf('%s/%s', $this->anymarket->getEndpoint(), $this->service);

        return $this->setParams($params)->sendRequest('POST', $url);
    }

    public function update($id, array $params)
    {
        $url = sprintf('%s/%s/%s', $this->anymarket->getEndpoint(), $this->service, $id);

        return $this->setParams($params)->sendRequest('PUT', $url);
    }

    public function find($id)
    {
        $url = sprintf('%s/%s/%s', $this->anymarket->getEndpoint(), $this->service, $id);

        return $this->sendRequest('GET', $url);
    }

    public function delete($id)
    {
        $url = sprintf('%s/%s/%s', $this->anymarket->getEndpoint(), $this->service, $id);

        return $this->sendRequest('DELETE', $url);
    }

    public function sendRequest($method, $url)
    {
        try {
            $requestParams = [];

            if (in_array($method, ['PUT', 'POST'])) {
                $requestParams = [
                    'json' => $this->params,
                ];
            }

            $request = $this->http->request($method, $url, $requestParams);

            return json_decode($request->getBody()->getContents(), true);
        } catch (ClientException $e) {
            if ($e->getCode() == 422) {
                throw new AnymarketValidationException($e->getMessage(), $e->getCode());
            }

            throw new AnymarketException($e->getMessage(), $e->getCode());
        }
    }
}
