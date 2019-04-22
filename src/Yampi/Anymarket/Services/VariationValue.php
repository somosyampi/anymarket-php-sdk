<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Contracts\VariationValueInterface;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Exceptions\AnymarketException;

class VariationValue extends BaseRequest implements VariationValueInterface
{
    protected $variation;

    public function __construct(Anymarket $anymarket, $http)
    {
        parent::__construct($anymarket, 'variations', $http);
    }

    public function setVariation($variation)
    {
        $this->variation = $variation;
        return $this;
    }

    public function get($offset = 0, $limit = 50)
    {
        if (!$this->variation) {
            throw new AnymarketException('É necessarios utilizar o setVariation para atribuir uma variação !', 400);
        }

        $url = sprintf('%s/variations/%s/values', $this->anymarket->getEndpoint(), $this->variation);

        return $this->sendRequest('GET', $url);
    }

    public function find($id)
    {
        if (!$this->variation) {
            throw new AnymarketException('É necessarios utilizar o setVariation para atribuir uma variação !', 400);
        }

        $url = sprintf('%s/variations/%s/values/%s', $this->anymarket->getEndpoint(), $this->variation, $id);

        return $this->sendRequest('GET', $url);
    }

    public function create(array $params)
    {
        if (!$this->variation) {
            throw new AnymarketException('É necessarios utilizar o setVariation para atribuir uma variação !', 400);
        }
        
        $url = sprintf('%s/variations/%s/values', $this->anymarket->getEndpoint(), $this->variation);
        
        return $this->setParams($params)->sendRequest('POST', $url);
    }

    public function update($id, array $params)
    {
        if (!$this->variation) {
            throw new AnymarketException('É necessarios utilizar o setVariation para atribuir uma variação !', 400);
        }
        
        $url = sprintf('%s/variations/%s/values/%s', $this->anymarket->getEndpoint(), $this->variation, $id);

        return $this->setParams($params)->sendRequest('PUT', $url);
    }

    public function delete($id)
    {
        $url = sprintf('%s/variations/%s/values/%s', $this->anymarket->getEndpoint(), $this->variation, $id);

        return $this->sendRequest('DELETE', $url);
    }
}
