<?php

namespace Tests\Services;

use Tests\TestCase;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Exceptions\AnymarketException;
use Yampi\Anymarket\Exceptions\AnymarketValidationException;
use Yampi\Anymarket\Services\Callback;
use Yampi\Anymarket\Services\Environment;

class CallbackTest extends TestCase
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

    public function test_get_callback()
    {
        $body = __DIR__.'/../ResponseSamples/Callback/CallbackGet.json';
        $http = $this->mockHttpClient($body, 200);

        $callback = new Callback($this->anymarket, $http);

        $callback = $callback->get(0, 50);

        $this->assertArrayHasKey('links', $callback);
        $this->assertArrayHasKey('content', $callback);
        $this->assertArrayHasKey('page', $callback);
    }

    public function test_find_callback()
    {
        $body = __DIR__.'/../ResponseSamples/Callback/Callback.json';
        $http = $this->mockHttpClient($body, 200);

        $callback = new Callback($this->anymarket, $http);

        $callback = $callback->find(123);

        $this->assertArrayHasKey('id', $callback);
        $this->assertArrayHasKey('url', $callback);
        $this->assertArrayHasKey('token', $callback);
    }

    public function test_unprocessable_callback()
    {
        $body = __DIR__.'/../ResponseSamples/Callback/Callback.json';
        $http = $this->mockHttpClient($body, 422);

        $callback = new Callback($this->anymarket, $http);

        $this->expectException(AnymarketValidationException::class);

        $callback = $callback->create([]);
    }

    public function test_find_callback_not_found()
    {
        $body = __DIR__.'/../ResponseSamples/Callback/Callback.json';
        $http = $this->mockHttpClient($body, 404);

        $callback = new Callback($this->anymarket, $http);

        $this->expectException(AnymarketException::class);

        $callback = $callback->find(123);
    }

    public function test_create_callback()
    {
        $body = __DIR__.'/../ResponseSamples/Callback/Callback.json';
        $http = $this->mockHttpClient($body, 200);

        $callback = new Callback($this->anymarket, $http);

        $callback = $callback->create([
            'url' => 'teste.url.com',
        ]);

        $this->assertArrayHasKey('id', $callback);
        $this->assertArrayHasKey('url', $callback);
        $this->assertArrayHasKey('token', $callback);
    }

    public function test_update_callback()
    {
        $body = __DIR__.'/../ResponseSamples/Callback/Callback.json';
        $http = $this->mockHttpClient($body, 200);

        $callback = new Callback($this->anymarket, $http);

        $callback = $callback->update(123, [
            'url' => 'teste.url.update.com',
        ]);

        $this->assertArrayHasKey('id', $callback);
        $this->assertArrayHasKey('url', $callback);
        $this->assertArrayHasKey('token', $callback);
    }

    public function test_delete_callback()
    {
        $body = __DIR__.'/../ResponseSamples/NoContent.json';

        $http = $this->mockHttpClient($body, 204);

        $callback = new Callback($this->anymarket, $http);

        $this->assertNull($callback->delete(123));
    }
}
