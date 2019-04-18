<?php

namespace Tests\Services;

use Tests\TestCase;
use Yampi\Anymarket\Anymarket;
use Yampi\Anymarket\Services\Environment;
use Yampi\Anymarket\Services\Brand;

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

    public function test_brand_create()
    {
        $body = __DIR__.'/../ResponseSamples/Brand/BrandCreate.json';
        $http = $this->mockHttpClient($body, 200);

        $test = $http->get('/');

        dd(json_decode($test->getBody()->getContents(), true));

        dd($http);
        
    }
}