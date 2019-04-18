<?php

namespace Tests;

use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Contracts\BrandInterface;
use Yampi\Anymarket\Contracts\CategoryInterface;
use Yampi\Anymarket\Contracts\OrderInterface;
use Yampi\Anymarket\Contracts\ProductInterface;
use Yampi\Anymarket\Contracts\SkuInterface;
use Yampi\Anymarket\Contracts\StockInterface;
use Yampi\Anymarket\Contracts\VariationInterface;
use Yampi\Anymarket\Contracts\VariationValueInterface;

class ClientTest extends TestCase
{
    protected $anymarket;

    public function setUp()
    {
        parent::setUp();

        $this->anymarket = new Anymarket('TOKEN', Environment::sandbox());
    }

    public function test_brand_service()
    {
        $this->assertInstanceOf(BrandInterface::class, $this->anymarket->brand());
    }

    public function test_category_service()
    {
        $this->assertInstanceOf(CategoryInterface::class, $this->anymarket->category());
    }

    public function test_order_service()
    {
        $this->assertInstanceOf(OrderInterface::class, $this->anymarket->order());
    }

    public function test_product_service()
    {
        $this->assertInstanceOf(ProductInterface::class, $this->anymarket->product());
    }

    public function test_sku_service()
    {
        $this->assertInstanceOf(SkuInterface::class, $this->anymarket->sku());
    }

    public function test_stock_service()
    {
        $this->assertInstanceOf(StockInterface::class, $this->anymarket->stock());
    }

    public function test_variation_service()
    {
        $this->assertInstanceOf(VariationInterface::class, $this->anymarket->variation());
    }

    public function test_variation_value_service()
    {
        $this->assertInstanceOf(VariationValueInterface::class, $this->anymarket->variationValue());
    }
}