<?php

namespace Tests\Functional;

class MembersTest extends BaseTestCase
{
    public $baseUrl = "/members";

    public function testDelete()
    {
        // Mock 405 request
        $response = $this->runApp('DELETE', $this->baseUrl);
        $this->assertEquals(405, $response->getStatusCode());
    }

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

    public function testPostId()
    {
        // Mock request
        $data = [
            "name" => "Javier",
            "surname" => "Garcia",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $response = $this->runApp('POST', $this->baseUrl . "/1", $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(405, $response->getStatusCode());
    }

    public function testPatch()
    {
        // Mock request
        $data = [
            "surname" => "Cava Platas",
        ];
        $response = $this->runApp('PATCH', $this->baseUrl, $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(405, $response->getStatusCode());
    }

    public function testPatchId()
    {
        // Mock request
        $data = [
            "surname" => "Cava Platas",
        ];
        $response = $this->runApp('PATCH', $this->baseUrl . "/1", $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(200, $response->getStatusCode());
        $expected = [
            "surname" => "Cava Platas",
            "id" => 1
        ];
        $this->assertEquals($expected, $body);
    }

    public function testPut()
    {
        // Mock request
        $data = [
            "id" => 1,
            "name" => "Juan",
            "surname" => "Cava",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $response = $this->runApp('PUT', $this->baseUrl, $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(405, $response->getStatusCode());
    }

    public function testPutId()
    {
        // Mock request
        $data = [
            "id" => 1,
            "name" => "Juan",
            "surname" => "Cava",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $response = $this->runApp('PUT', $this->baseUrl . "/1", $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(405, $response->getStatusCode());
    }
}
