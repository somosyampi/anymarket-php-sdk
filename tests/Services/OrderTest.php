<?php

namespace Tests\Services;

use Tests\TestCase;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Exceptions\AnymarketException;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Services\Order;

class OrderTest extends TestCase
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

    public function test_get_order()
    {
        $body = __DIR__.'/../ResponseSamples/Order/OrderGet.json';
        $http = $this->mockHttpClient($body, 200);

        $brand = new Order($this->anymarket, $http);

        $brand = $brand->get(0, 50);

        $this->assertArrayHasKey('links', $brand);
        $this->assertArrayHasKey('content', $brand);
        $this->assertArrayHasKey('page', $brand);
    }

    public function test_find_order()
    {
        $body = __DIR__.'/../ResponseSamples/Order/Order.json';
        $http = $this->mockHttpClient($body, 200);

        $order = new Order($this->anymarket, $http);

        $order = $order->find(123);

        $this->assertJsonStringEqualsJsonFile($body, json_encode($order));
    }

    public function test_find_order_not_found()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 404);

        $order = new Order($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $order = $order->find(123);
    }

    public function test_create_order()
    {
        $http = $this->mockHttpClient();

        $order = new Order($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $order = $order->create([]);
    }

    public function test_delete_order()
    {
        $http = $this->mockHttpClient();

        $order = new Order($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $order = $order->delete(123);
    }

    public function test_update_order()
    {
        $http = $this->mockHttpClient();

        $order = new Order($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $order = $order->update(123, []);
    }

    public function test_update_status_order()
    {
        $body = __DIR__.'/../ResponseSamples/Order/Order.json';
        $http = $this->mockHttpClient($body, 200);

        $order = new Order($this->anymarket, $http);

        $order = $order->updateStatus(123, [
            'status' => 'PAID_WAITING_SHIP',
        ]);

        $this->assertJsonStringEqualsJsonFile($body, json_encode($order));
    }

    public function test_feed_order()
    {
        $body = __DIR__.'/../ResponseSamples/Order/OrderFeed.json';
        $http = $this->mockHttpClient($body, 200);

        $order = new Order($this->anymarket, $http);

        $order = $order->feed();

        $this->assertTrue(is_array($order));
    }

    public function test_feed_update_order()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 204);

        $order = new Order($this->anymarket, $http);

        $this->assertNull($order->feedUpdate(123, 'token_feed'));
    }
}
