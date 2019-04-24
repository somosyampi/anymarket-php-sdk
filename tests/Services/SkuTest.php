<?php

namespace Tests\Services;

use Tests\TestCase;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Exceptions\AnymarketException;
use Yampi\Anymarket\Exceptions\AnymarketValidationException;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Services\Sku;

class SkuTest extends TestCase
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

    public function test_set_product_sku()
    {
        $body = __DIR__.'/../ResponseSamples/Sku/Sku.json';
        $http = $this->mockHttpClient($body, 200);

        $skus = new Sku($this->anymarket, $http);

        $this->assertInstanceOf(Sku::class, $skus->setProduct(123));
    }

    public function test_sku_product_not_found()
    {
        $body = __DIR__.'/../ResponseSamples/Sku/SkuGet.json';
        $http = $this->mockHttpClient($body, 200);

        $skus = new Sku($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $skus = $skus->get(0, 50);
    }

    public function test_get_sku()
    {
        $body = __DIR__.'/../ResponseSamples/Sku/SkuGet.json';
        $http = $this->mockHttpClient($body, 200);

        $skus = new Sku($this->anymarket, $http);

        $skus = $skus->setProduct(123)->get(0, 50);

        $this->assertTrue(is_array($skus));
    }

    public function test_find_sku()
    {
        $body = __DIR__.'/../ResponseSamples/Sku/Sku.json';
        $http = $this->mockHttpClient($body, 200);

        $sku = new Sku($this->anymarket, $http);

        $sku = $sku->setProduct(123)->find(123);

        $this->assertArrayHasKey('id', $sku);
        $this->assertArrayHasKey('title', $sku);
        $this->assertArrayHasKey('partnerId', $sku);
        $this->assertArrayHasKey('ean', $sku);
        $this->assertArrayHasKey('amount', $sku);
        $this->assertArrayHasKey('additionalTime', $sku);
        $this->assertArrayHasKey('price', $sku);
        $this->assertArrayHasKey('sellPrice', $sku);
        $this->assertArrayHasKey('variations', $sku);
    }

    public function test_unprocessable_sku()
    {
        $body = __DIR__.'/../ResponseSamples/Sku/Sku.json';
        $http = $this->mockHttpClient($body, 422);

        $sku = new Sku($this->anymarket, $http);

        $this->expectException(AnymarketValidationException::class);

        $sku = $sku->setProduct(123)->create([]);
    }

    public function test_find_sku_not_found()
    {
        $body = __DIR__.'/../ResponseSamples/Sku/Sku.json';
        $http = $this->mockHttpClient($body, 404);

        $sku = new Sku($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $sku = $sku->setProduct(123)->find(123);
    }

    public function test_create_sku()
    {
        $body = __DIR__.'/../ResponseSamples/Sku/Sku.json';
        $http = $this->mockHttpClient($body, 200);

        $sku = new Sku($this->anymarket, $http);

        $sku = $sku->setProduct(123)->create([
            'title'          => 'test',
            'partnerId'      => '123',
            'ean'            => '1234567891234',
            'amount'         => 10,
            'price'          => 100,
            'additionalTime' => 1,
        ]);

        $this->assertArrayHasKey('id', $sku);
        $this->assertArrayHasKey('title', $sku);
        $this->assertArrayHasKey('partnerId', $sku);
        $this->assertArrayHasKey('ean', $sku);
        $this->assertArrayHasKey('amount', $sku);
        $this->assertArrayHasKey('additionalTime', $sku);
        $this->assertArrayHasKey('price', $sku);
        $this->assertArrayHasKey('sellPrice', $sku);
        $this->assertArrayHasKey('variations', $sku);
    }

    public function test_update_sku()
    {
        $body = __DIR__.'/../ResponseSamples/Sku/Sku.json';
        $http = $this->mockHttpClient($body, 200);

        $sku = new Sku($this->anymarket, $http);

        $sku = $sku->setProduct(123)->update(123, [
            'title' => 'test',
        ]);

        $this->assertArrayHasKey('id', $sku);
        $this->assertArrayHasKey('title', $sku);
        $this->assertArrayHasKey('partnerId', $sku);
        $this->assertArrayHasKey('ean', $sku);
        $this->assertArrayHasKey('amount', $sku);
        $this->assertArrayHasKey('additionalTime', $sku);
        $this->assertArrayHasKey('price', $sku);
        $this->assertArrayHasKey('sellPrice', $sku);
        $this->assertArrayHasKey('variations', $sku);
    }

    public function test_delete_sku()
    {
        $body = __DIR__.'/../ResponseSamples/Sku/Sku.json';
        $http = $this->mockHttpClient($body, 200);

        $skus = new Sku($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $skus = $skus->setProduct(123)->delete(123);
    }
}
