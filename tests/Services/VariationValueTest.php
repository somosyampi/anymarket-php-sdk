<?php

namespace Tests\Services;

use Tests\TestCase;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Services\VariationValue;
use Yampi\Anymarket\Exceptions\AnymarketException;
use Yampi\Anymarket\Exceptions\AnymarketValidationException;

class VariationValueTest extends TestCase
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

    public function test_set_variation()
    {
        $http = $this->mockHttpClient();

        $value = new VariationValue($this->anymarket, $http);

        $this->assertInstanceOf(VariationValue::class, $value->setVariation(123));
    }

    public function test_variation_not_found()
    {
        $http = $this->mockHttpClient();

        $value = new VariationValue($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $value = $value->get(0, 50);
    }

    public function test_get_variation_value()
    {
        $body = __DIR__ . '/../ResponseSamples/VariationValue/VariationValueGet.json';
        $http = $this->mockHttpClient($body, 200);

        $values = new VariationValue($this->anymarket, $http);

        $values = $values->setVariation(123)->get(0, 50);

        $this->assertArrayHasKey('links', $values);
        $this->assertArrayHasKey('content', $values);
        $this->assertArrayHasKey('page', $values);
    }

    public function test_find_variation_value()
    {
        $body = __DIR__ . '/../ResponseSamples/VariationValue/VariationValue.json';
        $http = $this->mockHttpClient($body, 200);

        $value = new VariationValue($this->anymarket, $http);

        $value = $value->setVariation(123)->find(123);

        $this->assertArrayHasKey('id', $value);
        $this->assertArrayHasKey('description', $value);
        $this->assertArrayHasKey('partnerId', $value);
    }

    public function test_unprocessable_variation_value()
    {
        $body = __DIR__ . '/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 422);

        $value = new VariationValue($this->anymarket, $http);

        $this->expectException(AnymarketValidationException::class);

        $value->setVariation(123)->create([]);
    }

    public function test_find_variation_value_not_found()
    {
        $body = __DIR__ . '/../ResponseSamples/NoContent.json';
        $http = $this->mockHttpClient($body, 404);

        $value = new VariationValue($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $value = $value->setVariation(123)->find(123);
    }

    public function test_create_variation_value()
    {
        $body = __DIR__ . '/../ResponseSamples/VariationValue/VariationValue.json';
        $http = $this->mockHttpClient($body, 200);

        $value = new VariationValue($this->anymarket, $http);

        $value = $value->setVariation(123)->create([
            'description' => 'test',
            'partnerId' => '123'
        ]);

        $this->assertArrayHasKey('id', $value);
        $this->assertArrayHasKey('description', $value);
        $this->assertArrayHasKey('partnerId', $value);
    }

    public function test_update_variation_value()
    {
        $body = __DIR__ . '/../ResponseSamples/VariationValue/VariationValue.json';
        $http = $this->mockHttpClient($body, 200);

        $value = new VariationValue($this->anymarket, $http);

        $value = $value->setVariation(123)->update(123, [
            'description' => 'test',
        ]);

        $this->assertArrayHasKey('id', $value);
        $this->assertArrayHasKey('description', $value);
        $this->assertArrayHasKey('partnerId', $value);
    }

    public function test_delete_variation_value()
    {
        $body = __DIR__ . '/../ResponseSamples/NoContent.json';

        $http = $this->mockHttpClient($body, 204);

        $value = new VariationValue($this->anymarket, $http);

        $this->assertNull($value->setVariation(123)->delete(123));
    }
}
