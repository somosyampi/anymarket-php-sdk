<?php

namespace Tests\Services;

use Tests\TestCase;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Services\Brand;
use Yampi\Anymarket\Exceptions\AnymarketException;
use Yampi\Anymarket\Exceptions\AnymarketValidationException;

class BrandTest extends TestCase
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

    public function test_get_brand()
    {
        $body = __DIR__.'/../ResponseSamples/Brand/BrandGet.json';
        $http = $this->mockHttpClient($body, 200);

        $brand = new Brand($this->anymarket, $http);

        $brand = $brand->get(0, 50);

        $this->assertArrayHasKey('links', $brand);
        $this->assertArrayHasKey('content', $brand);
        $this->assertArrayHasKey('page', $brand);
    }

    public function test_find_brand()
    {
        $body = __DIR__.'/../ResponseSamples/Brand/Brand.json';
        $http = $this->mockHttpClient($body, 200);

        $brand = new Brand($this->anymarket, $http);

        $brand = $brand->find(123);

        $this->assertArrayHasKey('id', $brand);
        $this->assertArrayHasKey('name', $brand);
        $this->assertArrayHasKey('partnerId', $brand);
    }

    public function test_unprocessable_brand()
    {
        $body = __DIR__.'/../ResponseSamples/Brand/Brand.json';
        $http = $this->mockHttpClient($body, 422);

        $brand = new Brand($this->anymarket, $http);

        $this->expectException(AnymarketValidationException::class);

        $brand = $brand->create([]);
    }

    public function test_find_brand_not_found()
    {
        $body = __DIR__.'/../ResponseSamples/Brand/Brand.json';
        $http = $this->mockHttpClient($body, 404);

        $brand = new Brand($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $brand = $brand->find(123);
    }

    public function test_create_brand()
    {
        $body = __DIR__.'/../ResponseSamples/Brand/Brand.json';
        $http = $this->mockHttpClient($body, 200);

        $brand = new Brand($this->anymarket, $http);

        $brand = $brand->create([
            'name' => 'teste',
            'partnerId' => '123'
        ]);

        $this->assertArrayHasKey('id', $brand);
        $this->assertArrayHasKey('name', $brand);
        $this->assertArrayHasKey('partnerId', $brand);
    }

    public function test_update_brand()
    {
        $body = __DIR__.'/../ResponseSamples/Brand/Brand.json';
        $http = $this->mockHttpClient($body, 200);

        $brand = new Brand($this->anymarket, $http);

        $brand = $brand->update(123, [
            'name' => 'teste',
            'partnerId' => '123'
        ]);

        $this->assertArrayHasKey('id', $brand);
        $this->assertArrayHasKey('name', $brand);
        $this->assertArrayHasKey('partnerId', $brand);
    }

    public function test_delete_brand()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';

        $http = $this->mockHttpClient($body, 204);

        $brand = new Brand($this->anymarket, $http);

        $this->assertNull($brand->delete(123));
    }
}
