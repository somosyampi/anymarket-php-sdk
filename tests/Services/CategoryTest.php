<?php

namespace Tests\Services;

use Tests\TestCase;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Services\Category;
use Yampi\Anymarket\Exceptions\AnymarketException;
use Yampi\Anymarket\Exceptions\AnymarketValidationException;

class CategoryTest extends TestCase
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

    public function test_get_category()
    {
        $body = __DIR__.'/../ResponseSamples/Category/CategoryGet.json';
        $http = $this->mockHttpClient($body, 200);

        $categories = new Category($this->anymarket, $http);

        $categories = $categories->get(0, 50);

        $this->assertArrayHasKey('links', $categories);
        $this->assertArrayHasKey('content', $categories);
        $this->assertArrayHasKey('page', $categories);
    }

    public function test_get_category_path()
    {
        $body = __DIR__.'/../ResponseSamples/Category/CategoryGet.json';
        $http = $this->mockHttpClient($body, 200);

        $categories = new Category($this->anymarket, $http);

        $categories = $categories->get(0, 50);

        $this->assertTrue(is_array($categories));
    }

    public function test_find_category()
    {
        $body = __DIR__.'/../ResponseSamples/Category/Category.json';
        $http = $this->mockHttpClient($body, 200);

        $category = new Category($this->anymarket, $http);

        $category = $category->find(123);

        $this->assertArrayHasKey('id', $category);
        $this->assertArrayHasKey('name', $category);
        $this->assertArrayHasKey('parent', $category);
        $this->assertArrayHasKey('partnerId', $category);
        $this->assertArrayHasKey('children', $category);
        $this->assertArrayHasKey('definitionPriceScope', $category);
    }

    public function test_unprocessable_category()
    {
        $body = __DIR__.'/../ResponseSamples/Category/Category.json';
        $http = $this->mockHttpClient($body, 422);

        $category = new Category($this->anymarket, $http);

        $this->expectException(AnymarketValidationException::class);

        $category = $category->create([]);
    }

    public function test_find_brand_not_found()
    {
        $body = __DIR__.'/../ResponseSamples/Category/Category.json';
        $http = $this->mockHttpClient($body, 404);

        $category = new Category($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $category = $category->find(123);
    }

    public function test_create_category()
    {
        $body = __DIR__.'/../ResponseSamples/Category/Category.json';
        $http = $this->mockHttpClient($body, 200);

        $category = new Category($this->anymarket, $http);

        $category = $category->create([
            'name' => 'test',
            'partnerId' => '123',
            'parent' => [
                'id' => 12
            ],
            'priceFactor' => 1,
            'calculatedPrice' => true,
            'definitionPriceScope' => 'sku'
        ]);

        $this->assertArrayHasKey('id', $category);
        $this->assertArrayHasKey('name', $category);
        $this->assertArrayHasKey('parent', $category);
        $this->assertArrayHasKey('partnerId', $category);
        $this->assertArrayHasKey('children', $category);
        $this->assertArrayHasKey('definitionPriceScope', $category);
    }

    public function test_update_category()
    {
        $body = __DIR__.'/../ResponseSamples/Category/Category.json';
        $http = $this->mockHttpClient($body, 200);

        $category = new Category($this->anymarket, $http);

        $category = $category->update(123, [
            'name' => 'test update',
            'partnerId' => '1234',
        ]);

        $this->assertArrayHasKey('id', $category);
        $this->assertArrayHasKey('name', $category);
        $this->assertArrayHasKey('parent', $category);
        $this->assertArrayHasKey('partnerId', $category);
        $this->assertArrayHasKey('children', $category);
        $this->assertArrayHasKey('definitionPriceScope', $category);
    }

    public function test_delete_category()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 204);

        $category = new Category($this->anymarket, $http);

        $this->assertNull($category->delete(123));
    }
}
