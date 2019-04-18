<?php

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Contracts\CategoryInterface;

class Category extends BaseRequest implements CategoryInterface
{
    public function __construct(Anymarket $anymarket, $http)
    {
        parent::__construct($anymarket, 'categories', $http);
    }

    public function getPath($offset, $limit = 50)
    {
        $url = sprintf('%s/categories/fullPath?offset=%s&limit=%s', $this->anymarket->getEndpoint(), $offset, $limit);

        return $this->sendRequest('GET', $url);
    }
}
