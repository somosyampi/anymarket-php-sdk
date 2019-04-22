<?php

namespace Tests\Services;

use Tests\TestCase;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Services\Stock;
use Yampi\Anymarket\Exceptions\AnymarketException;
use Yampi\Anymarket\Exceptions\AnymarketValidationException;

class StockTest extends TestCase
{
    protected $anymarket;

    public function setUp()
    {
        parent::setUp();

        $this->anymarket = new Anymarket(
            'TOKEN',
            Environment::sandbox()
        );
    }
    
    public function test_get_locals_stock()
    {
        $body = __DIR__.'/../ResponseSamples/Stock/StockLocals.json';
        $http = $this->mockHttpClient($body, 200);

        $stockLocals = new Stock($this->anymarket, $http);

        $stockLocals = $stockLocals->getLocals();

        $this->assertTrue(is_array($stockLocals));
    }

    public function test_find_stock()
    {
        $http = $this->mockHttpClient();

        $stock = new Stock($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $stock = $stock->find(123);
    }

    public function test_get_stock()
    {
        $http = $this->mockHttpClient();

        $stock = new Stock($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $stock = $stock->get();
    }

    public function test_unprocessable_stock()
    {
        $body = __DIR__.'/../ResponseSamples/Stock/StockLocals.json';
        $http = $this->mockHttpClient($body, 422);

        $stock = new Stock($this->anymarket, $http);

        $this->expectException(AnymarketValidationException::class);

        $stock = $stock->create([]);
    }

    public function test_create_stock()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 204);

        $stock = new Stock($this->anymarket, $http);

        $stock = $stock->create([
            [
                "id" => 123,
                "partnerId" => 123,
                "quantity" => 10,
                "cost" => 10,
                "additionalTime" => 1,
                "stockLocalId" => 123
            ]
        ]);

        $this->assertNull($stock);
    }

    public function test_update_stock()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 204);

        $stock = new Stock($this->anymarket, $http);

        $stock = $stock->update(123, [
                "id" => 123,
                "partnerId" => 123,
                "quantity" => 10,
                "cost" => 10,
                "additionalTime" => 1,
                "stockLocalId" => 123
        ]);

        $this->assertNull($stock);
    }

    public function test_update_price_stock()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 204);

        $stock = new Stock($this->anymarket, $http);

        $stock = $stock->updatePrice(123, 220);

        $this->assertNull($stock);
    }

    public function test_update_stock_quantity_stock()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 204);

        $stock = new Stock($this->anymarket, $http);

        $stock = $stock->updateStockQuantity(123, 50);

        $this->assertNull($stock);
    }

    public function test_delete_stock()
    {
        $http = $this->mockHttpClient();

        $stock = new Stock($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $stock = $stock->delete(123);
    }
}
