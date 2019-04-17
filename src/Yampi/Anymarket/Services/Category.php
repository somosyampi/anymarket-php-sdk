<?php 

namespace Yampi\Anymarket\Services;

use Yampi\Anymarket\Anymarket;

class Category extends BaseRequest
{
    public function __construct(Anymarket $anymarket)
    {  
        parent::__construct($anymarket, 'categories');   
    }

    public function getPath($offset, $limit = 50)
    {
        $url = sprintf('%s/categories/fullPath?offset=%s&limit=%s', $this->anymarket->getEndpoint(), $offset, $limit);

        return $this->sendRequest('GET', $url);
    }
}