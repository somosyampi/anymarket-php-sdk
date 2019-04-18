<?php

namespace Tests;

use Mockery;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit_Framework_TestCase;
use GuzzleHttp\Handler\MockHandler;

class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Mocks Guzzle HTTP client.
     *
     * @param  string|null $responseBodyFile
     * @param  int $httpCode
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockHttpClient($responseBodyFile = null, $httpCode = 200)
    {
        $mock = new MockHandler;

        if ($responseBodyFile) {
            $mock->append(new Response($httpCode, [], file_get_contents(realpath($responseBodyFile))));
        }

        return new Client([
            'handler' => HandlerStack::create($mock),
        ]);
    }

}