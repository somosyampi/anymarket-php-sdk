<?php

namespace Yampi\Anymarket;

use Yampi\Anymarket\Services\Product;
use Yampi\Anymarket\Services\Brand;
use Yampi\Anymarket\Services\Category;
use Yampi\Anymarket\Services\Sku;
use Yampi\Anymarket\Services\Stock;
use Yampi\Anymarket\Services\Order;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Services\Variation;
use Yampi\Anymarket\Services\VariationValue;

class Anymarket
{
    protected $token;

    protected $environment;

    protected $endpoint;

    protected $product;
    protected $brand;
    protected $cateogry;
    protected $sku;
    protected $stock;
    protected $order;
    protected $variation;
    protected $variationValue;

    public function __construct($token, Environment $environment)
    {
        $this->endpoint = $environment->getEndpoint();
        $this->token = $token;

        $this->product = new Product($this);
        $this->brand = new Brand($this);
        $this->category = new Category($this);
        $this->sku = new Sku($this);
        $this->stock = new Stock($this);
        $this->order = new Order($this);
        $this->variation = new Variation($this);
        $this->variationValue = new VariationValue($this);
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
