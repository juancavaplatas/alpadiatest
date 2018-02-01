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
        // Mock 400 request
        $response = $this->runApp('DELETE', $this->baseUrl . '/1000');
        $this->assertEquals(204, $response->getStatusCode());
        // Mock 200 request
        $response = $this->runApp('DELETE', $this->baseUrl . '/2');
        $this->assertEquals(200, $response->getStatusCode());
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
        // Mock bad request
        $response = $this->runApp('GET', $this->baseUrl . '/1000');
        $body = json_decode((string)$response->getBody(), true);
        $this->assertEquals(204, $response->getStatusCode());

        // Mock request
        $response = $this->runApp('GET', $this->baseUrl . '/1');
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(200, $response->getStatusCode());
        $expected = [
            "id" => 1,
            "name" => "Juan",
            "surname" => "Cava",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $this->assertEquals($expected, $body);
    }

    public function testGetIdGames()
    {
        // Mock request
        $response = $this->runApp('GET', $this->baseUrl . '/1/games');
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInternalType("array", $body);
        $this->assertEquals(1, count($body));
        $this->assertInternalType("array", $body[0]);
        $this->assertEquals(1, $body[0]["id"]);
        $this->assertEquals("Megaman", $body[0]["name"]);
        $this->assertEquals("2017-01-01 00:00:00", $body[0]["created"]);
        $this->assertInternalType("string", $body[0]["modified"]);
    }

    public function testPatch()
    {
        // Mock request
        $data = [
            "surname" => "Cava Platas",
        ];
        $response = $this->runApp('PATCH', $this->baseUrl, $data);
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
        $this->assertInternalType("array", $body);
        $this->assertEquals(1, $body["id"]);
        $this->assertEquals("Juan", $body["name"]);
        $this->assertEquals("2017-01-01 00:00:00", $body["created"]);
        $this->assertInternalType("string", $body["modified"]);
    }

    public function testPost()
    {
        // Mock request
        $data = [
            "name" => "Javier",
            "surname" => "Garcia"
        ];
        $response = $this->runApp('POST', $this->baseUrl, $data);
        $body = json_decode((string)$response->getBody(), true);
        // Make assertions
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInternalType("array", $body);
        $this->assertEquals(3, $body["id"]);
        $this->assertEquals($data["name"], $body["name"]);
        $this->assertEquals($data["surname"], $body["surname"]);
        $this->assertInternalType("string", $body["created"]);
        $this->assertInternalType("string", $body["modified"]);
    }

    public function testPostId()
    {
        // Mock request
        $data = [
            "name" => "Javier",
            "surname" => "Garcia"
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
