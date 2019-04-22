<?php

namespace Tests\Services;

use Tests\TestCase;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Services\Product;
use Yampi\Anymarket\Exceptions\AnymarketException;
use Yampi\Anymarket\Exceptions\AnymarketValidationException;

class ProductTest extends TestCase
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

    public function test_get_product()
    {
        $body = __DIR__.'/../ResponseSamples/Product/ProductGet.json';
        $http = $this->mockHttpClient($body, 200);

        $product = new Product($this->anymarket, $http);

        $product = $product->get(0, 50);

        $this->assertArrayHasKey('links', $product);
        $this->assertArrayHasKey('content', $product);
        $this->assertArrayHasKey('page', $product);
    }

    public function test_find_product()
    {
        $body = __DIR__.'/../ResponseSamples/Product/Product.json';
        $http = $this->mockHttpClient($body, 200);

        $product = new Product($this->anymarket, $http);

        $product = $product->find(123);

        $this->assertJsonStringEqualsJsonFile($body, json_encode($product));
    }

    public function test_unprocessable_product()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 422);

        $product = new Product($this->anymarket, $http);

        $this->expectException(AnymarketValidationException::class);

        $product = $product->create([]);
    }

    public function test_find_product_not_found()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 404);

        $product = new Product($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $product = $product->find(123);
    }

    public function test_create_product()
    {
        $body = __DIR__.'/../ResponseSamples/Product/Product.json';
        $http = $this->mockHttpClient($body, 200);

        $product = new Product($this->anymarket, $http);

        $product = $product->create([
            'title' => 'string',
            'description' => 'string',
            'category' => [
              'id' => 0,
              'name' => 'string',
              'path' => 'string'
            ],
            'brand' => [
              'id' => 0,
              'name' => 'string',
              'partnerId' => 'string'
            ],
            'nbm' => [
              'id' => 'string'
            ],
            'origin' => [
              'id' => 0
            ],
            'model' => 'string',
            'videoUrl' => 'string',
            'gender' => 'string',
            'warrantyTime' => 0,
            'warrantyText' => 'string',
            'height' => 0,
            'width' => 0,
            'weight' => 0,
            'length' => 0,
            'priceFactor' => 0,
            'calculatedPrice' => true,
            'definitionPriceScope' => 'string',
            'characteristics' => [
              [
                'index' => 0,
                'name' => 'string',
                'value' => 'string'
              ]
            ],
            'images' => [
              [
                'main' => true,
                'url' => 'string',
                'variation' => 'string'
              ]
            ],
            'skus' => [
              [
                'title' => 'string',
                'partnerId' => 'string',
                'ean' => 'string',
                'amount' => 0,
                'price' => 0,
                'additionalTime' => 0,
                'variations' => [
                  'variationName' => 'VariationValue'
                ]
              ]
            ],
            'allowAutomaticSkuMarketplaceCreation' => true
        ]);

        $this->assertJsonStringEqualsJsonFile($body, json_encode($product));
    }

    public function test_update_product()
    {
        $body = __DIR__.'/../ResponseSamples/Product/Product.json';
        $http = $this->mockHttpClient($body, 200);

        $product = new Product($this->anymarket, $http);

        $product = $product->update(123, [
            'title' => 'string',
            'description' => 'string',
            'category' => [
              'id' => 0,
              'name' => 'string',
              'path' => 'string'
            ],
            'brand' => [
              'id' => 0,
              'name' => 'string',
              'partnerId' => 'string'
            ],
            'nbm' => [
              'id' => 'string'
            ],
            'origin' => [
              'id' => 0
            ],
            'model' => 'string',
            'videoUrl' => 'string',
            'gender' => 'string',
            'warrantyTime' => 0,
            'warrantyText' => 'string',
            'height' => 0,
            'width' => 0,
            'weight' => 0,
            'length' => 0,
            'priceFactor' => 0,
            'calculatedPrice' => true,
            'definitionPriceScope' => 'string',
            'characteristics' => [
              [
                'index' => 0,
                'name' => 'string',
                'value' => 'string'
              ]
            ],
            'images' => [
              [
                'main' => true,
                'url' => 'string',
                'variation' => 'string'
              ]
            ],
            'skus' => [
              [
                'title' => 'string',
                'partnerId' => 'string',
                'ean' => 'string',
                'amount' => 0,
                'price' => 0,
                'additionalTime' => 0,
                'variations' => [
                  'variationName' => 'VariationValue'
                ]
              ]
            ],
            'allowAutomaticSkuMarketplaceCreation' => true
        ]);

        $this->assertJsonStringEqualsJsonFile($body, json_encode($product));
    }

    public function test_delete_product()
    {
        $http = $this->mockHttpClient();

        $product = new Product($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $product->delete(1234);
    }
}
