<?php

namespace Tests\Functional;

class GamesTest extends BaseTestCase
{
    public $baseUrl = "/games";

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

        // Mock 204 request
        $response = $this->runApp('DELETE', $this->baseUrl . '/1000');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function testGet()
    {
        // Mock request
        $response = $this->runApp('GET', $this->baseUrl);
        $body = json_decode((string)$response->getBody(), true);
        // Assertions
        $this->assertEquals(200, $response->getStatusCode());
        $expected = [
            0 => [
                "id" => 1,
                "name" => "Sonic the Hedgehog",
                "created" => "2017-01-01 00:00:00",
                "modified" => "2017-01-01 00:00:00"
            ],
            1 => [
                "id" => 3,
                "name" => "Street Fighter",
                "created" => "2017-01-01 00:00:00",
                "modified" => "2017-01-01 00:00:00"
            ],
            2 => [
                "id" => 4,
                "name" => "Tetris",
                "created" => "2017-01-01 00:00:00",
                "modified" => "2017-01-01 00:00:00"
            ]
        ];
        $this->assertEquals($expected, $body);
    }

    public function testGetId()
    {
        // Mock 204 request
        $response = $this->runApp('GET', $this->baseUrl . "/1000");
        $body = json_decode((string)$response->getBody(), true);
        // Assertions
        $this->assertEquals(204, $response->getStatusCode());
        $expected = [];
        $this->assertEquals($expected, $body);

        // Mock request
        $response = $this->runApp('GET', $this->baseUrl . "/1");
        $body = json_decode((string)$response->getBody(), true);
        // Assertions
        $this->assertEquals(200, $response->getStatusCode());
        $expected = [
            "id" => 1,
            "name" => "Sonic the Hedgehog",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $this->assertEquals($expected, $body);
    }

    public function testPatch()
    {
        // Mock request
        $data = [
            "name" => "Megaman",
        ];
        $response = $this->runApp('PATCH', $this->baseUrl, $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(405, $response->getStatusCode());
    }

    public function testPatchId()
    {
        // Mock 204 request
        $data = [
            "name" => "Megaman",
        ];
        $response = $this->runApp('PATCH', $this->baseUrl . "/1000", $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(204, $response->getStatusCode());

        // Mock 200 request
        $data = [
            "name" => "Megaman",
        ];
        $response = $this->runApp('PATCH', $this->baseUrl . "/1", $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInternalType("array", $body);
        $this->assertEquals(1, $body["id"]);
        $this->assertEquals($data["name"], $body["name"]);
        $this->assertEquals("2017-01-01 00:00:00", $body["created"]);
        $this->assertInternalType("string", $body["modified"]);
    }

    public function testPost()
    {
        // Mock request
        $data = [
            "name" => "Super Mario Bros"
        ];
        $response = $this->runApp('POST', $this->baseUrl, $data);
        $body = json_decode((string)$response->getBody(), true);
        // Assertions
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInternalType("array", $body);
        $this->assertEquals(5, $body["id"]);
        $this->assertEquals($data["name"], $body["name"]);
        $this->assertInternalType("string", $body["created"]);
        $this->assertInternalType("string", $body["modified"]);
    }

    public function testPostId()
    {
        // Mock request
        $data = [
            "name" => "Super Mario Bros",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $response = $this->runApp('POST', $this->baseUrl . "/1", $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(405, $response->getStatusCode());
    }

    public function testPut()
    {
        // Mock request
        $data = [
            "id" => 1,
            "name" => "Super Mario Bros",
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
            "name" => "Super Mario Bros",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $response = $this->runApp('PUT', $this->baseUrl . "/1", $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(405, $response->getStatusCode());
    }
}
