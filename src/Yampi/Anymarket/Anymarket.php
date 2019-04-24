<?php

namespace Yampi\Anymarket;

use GuzzleHttp\Client as Client;
use Yampi\Anymarket\Services\Brand;
use Yampi\Anymarket\Services\Category;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Services\Order;
use Yampi\Anymarket\Services\Product;
use Yampi\Anymarket\Services\Sku;
use Yampi\Anymarket\Services\Stock;
use Yampi\Anymarket\Services\Variation;
use Yampi\Anymarket\Services\VariationValue;

class Anymarket
{
    protected $token;

    protected $environment;

    protected $endpoint;

    protected $product;

    protected $brand;

    protected $category;

    protected $sku;

    protected $stock;

    protected $order;

    protected $variation;

    protected $variationValue;

    public function __construct($token, Environment $environment, $http = null)
    {
        $this->endpoint = $environment->getEndpoint();
        $this->token = $token;

        $this->http = $http ?: new Client([
            'headers' => [
                'gumgaToken'   => $token,
                'Content-Type' => 'application/json',
            ],
        ]);

        $this->product = new Product($this, $this->http);
        $this->brand = new Brand($this, $this->http);
        $this->category = new Category($this, $this->http);
        $this->sku = new Sku($this, $this->http);
        $this->stock = new Stock($this, $this->http);
        $this->order = new Order($this, $this->http);
        $this->variation = new Variation($this, $this->http);
        $this->variationValue = new VariationValue($this, $this->http);
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function product()
    {
        return $this->product;
    }

    public function brand()
    {
        return $this->brand;
    }

    public function category()
    {
        return $this->category;
    }

    public function sku()
    {
        return $this->sku;
    }

    public function stock()
    {
        return $this->stock;
    }

    public function order()
    {
        return $this->order;
    }

    public function variation()
    {
        return $this->variation;
    }

    public function variationValue()
    {
        return $this->variationValue;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }
}
