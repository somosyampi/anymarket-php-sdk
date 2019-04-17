<?php

namespace Yampi\Anymarket\Services;

use GuzzleHttp\Client as Client;
use Yampi\Anymarket\Anymarket;
use GuzzleHttp\Exceptions\RequestException;
use Yampi\Anymarket\Exceptions\AnymarketValidationException;
use Yampi\Anymarket\Excetpions\AnymarketException;
use Yampi\Anymarket\Contracts\BaseRequestInterface;

abstract class BaseRequest implements BaseRequestInterface
{
    protected $params;

    protected $service;

    public function __construct(Anymarket $anymarket, $service)
    {
        $this->anymarket = $anymarket;
        $this->service = $service;
    }

    public function setParams(Array $value)
    {
        $this->params = $value;
        return $this;
    }

    public function get($offset, $limit = 50)
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
            $token = $this->anymarket->getToken();

            $requestParams = [];

            if (in_array($method, ['PUT', 'POST'])) {
                $requestParams = [
                    'json' => $this->params,
                ];
            }

            $client = new Client([
                'headers' => [
                    'gumgaToken' => $token,
                    'Content-Type' => 'application/json',
                ],
            ]);

            $request = $client->request($method, $url, $requestParams);

            return json_decode($request->getBody()->getContents(), true);
            
        } catch (RequestException $e) {

            if ($e->getCode() == 422) {
                throw new AnymarketValidationException($e->getCode(), $e->getMessage());
            }

            throw new AnymarketException($e->getCode(), $e->getMessage());
        }
    }

}