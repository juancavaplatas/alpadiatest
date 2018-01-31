<?php

namespace Tests\Functional;

class MembersTest extends BaseTestCase
{
    public $baseUrl = "/members";

    public function testDeleteId()
    {
        // Mock 200 request
        $response = $this->runApp('DELETE', $this->baseUrl . '/2');
        $this->assertEquals(200, $response->getStatusCode());
        // Mock 400 request
        $response = $this->runApp('DELETE', $this->baseUrl . '/1000');
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testGet()
    {
        // Mock request
        $response = $this->runApp('GET', $this->baseUrl);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(200, $response->getStatusCode());
        $expected = [
            0 => [
                "name" => "Juan",
                "surname" => "Cava",
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
        $response = $this->runApp('GET', $this->baseUrl . '/1');
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(200, $response->getStatusCode());
        $expected = [
            "name" => "Juan",
            "surname" => "Cava",
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
            "name" => "Javier",
            "surname" => "Garcia",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $response = $this->runApp('POST', $this->baseUrl, $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(200, $response->getStatusCode());
        $expected = [
            "name" => "Javier",
            "surname" => "Garcia",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00",
            "id" => 3
        ];
        $this->assertEquals($expected, $body);
    }
}
