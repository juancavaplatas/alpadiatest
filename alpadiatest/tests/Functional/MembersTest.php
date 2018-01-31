<?php

namespace Tests\Functional;

class MembersTest extends BaseTestCase
{
    /**
     *
     */
    public function testGet()
    {
        $response = $this->runApp('GET', '/members');

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode((string)$response->getBody(), true);

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

    /**
     *
     */
    public function testGetId()
    {
        $response = $this->runApp('GET', '/members/1');

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode((string)$response->getBody(), true);

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
        $data = [
            "name" => "Javier",
            "surname" => "Garcia",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $response = $this->runApp('POST', '/members', $data);
        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode((string)$response->getBody(), true);
        $expected = [
            "name" => "Javier",
            "surname" => "Garcia",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00",
            "id" => 2
        ];
        $this->assertEquals($expected, $body);
    }
}
