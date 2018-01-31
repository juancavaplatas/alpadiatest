<?php

namespace Tests\Functional;

class VideogamesTest extends BaseTestCase
{
    public function testGet()
    {
        // Mock request
        $response = $this->runApp('GET', '/videogames');
        $body = json_decode((string)$response->getBody(), true);
        // Assertions
        $this->assertEquals(200, $response->getStatusCode());
        $expected = [
            0 => [
                "name" => "Sonic the Hedgehog",
                "created" => "2017-01-01 00:00:00",
                "modified" => "2017-01-01 00:00:00",
                "id" => 1
            ]
        ];
        $this->assertEquals($expected, $body);
    }

    public function testGetId()
    {
        // Mock request
        $response = $this->runApp('GET', '/videogames/1');
        $body = json_decode((string)$response->getBody(), true);
        // Assertions
        $this->assertEquals(200, $response->getStatusCode());
        $expected = [
            "name" => "Sonic the Hedgehog",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00",
            "id" => 1
        ];
        $this->assertEquals($expected, $body);
    }

    public function testPost()
    {
        // Mock request
        $data = [
            "name" => "Super Mario Bros",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $response = $this->runApp('POST', '/videogames', $data);
        $body = json_decode((string)$response->getBody(), true);
        // Assertions
        $this->assertEquals(200, $response->getStatusCode());
        $expected = [
            "name" => "Super Mario Bros",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00",
            "id" => 2
        ];
        $this->assertEquals($expected, $body);
    }
}