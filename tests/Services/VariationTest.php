<?php

namespace Tests\Services;

use Tests\TestCase;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Exceptions\AnymarketException;
use Yampi\Anymarket\Exceptions\AnymarketValidationException;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Services\Variation;

class VariationTest extends TestCase
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

    public function test_get_variation()
    {
        $body = __DIR__.'/../ResponseSamples/Variation/VariationGet.json';
        $http = $this->mockHttpClient($body, 200);

        $variations = new Variation($this->anymarket, $http);

        $variations = $variations->get(0, 50);

        $this->assertArrayHasKey('links', $variations);
        $this->assertArrayHasKey('content', $variations);
        $this->assertArrayHasKey('page', $variations);
    }

    public function test_find_variation()
    {
        $body = __DIR__.'/../ResponseSamples/Variation/Variation.json';
        $http = $this->mockHttpClient($body, 200);

        $variation = new Variation($this->anymarket, $http);

        $variation = $variation->find(123);

        $this->assertArrayHasKey('id', $variation);
        $this->assertArrayHasKey('name', $variation);
        $this->assertArrayHasKey('partnerId', $variation);
        $this->assertArrayHasKey('values', $variation);
        $this->assertTrue(is_array($variation['values']));
        $this->assertArrayHasKey('visualVariation', $variation);
    }

    public function test_unprocessable_variation()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 422);

        $variation = new Variation($this->anymarket, $http);

        $this->expectException(AnymarketValidationException::class);

        $variation = $variation->create([]);
    }

    public function test_find_variation_not_found()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 404);

        $variation = new Variation($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $variation = $variation->find(123);
    }

    public function test_create_variation()
    {
        $body = __DIR__.'/../ResponseSamples/Variation/Variation.json';
        $http = $this->mockHttpClient($body, 200);

        $variation = new Variation($this->anymarket, $http);

        $variation = $variation->create([
            'name'            => 'string',
            'partnerId'       => 'string',
            'visualVariation' => true,
            'values'          => [
                [
                    'description' => 'string',
                ],
            ],
        ]);

        $this->assertArrayHasKey('id', $variation);
        $this->assertArrayHasKey('name', $variation);
        $this->assertArrayHasKey('partnerId', $variation);
        $this->assertArrayHasKey('values', $variation);
        $this->assertTrue(is_array($variation['values']));
        $this->assertArrayHasKey('visualVariation', $variation);
    }

    public function test_update_variation()
    {
        $body = __DIR__.'/../ResponseSamples/Variation/Variation.json';
        $http = $this->mockHttpClient($body, 200);

        $variation = new Variation($this->anymarket, $http);

        $variation = $variation->update(123, [
            'name' => 'teste',
        ]);

        $this->assertArrayHasKey('id', $variation);
        $this->assertArrayHasKey('name', $variation);
        $this->assertArrayHasKey('partnerId', $variation);
        $this->assertArrayHasKey('values', $variation);
        $this->assertTrue(is_array($variation['values']));
        $this->assertArrayHasKey('visualVariation', $variation);
    }

    public function test_delete_variation()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';

        $http = $this->mockHttpClient($body, 204);

        $variation = new Variation($this->anymarket, $http);

        $this->assertNull($variation->delete(123));
    }
}
