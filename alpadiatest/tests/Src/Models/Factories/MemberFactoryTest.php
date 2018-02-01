<?php

use Alpadia\Models\Factories\MemberFactory as MemberFactory;
use PHPUnit\Framework\TestCase;

class MemberFactoryTest extends TestCase
{
    public function test_createFromArray()
    {
        $data = [
            "id" => 1,
            "name" => "Juan",
            "surname" => "Cava",
            "email" => "juan@gmail.com",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $member = MemberFactory::createFromArray($data);
        $this->assertInternalType("object", $member);
        $this->assertInstanceOf("Alpadia\Models\Entities\Member", $member);
        $keys = array_keys($member->getAttributes());
        $this->assertEquals(["id","name","surname","email","created","modified"], $keys);
        $this->assertEquals($data["id"], $member->id);
        $this->assertEquals($data["name"], $member->name);
        $this->assertEquals($data["surname"], $member->surname);
        $this->assertEquals($data["email"], $member->email);
        $this->assertEquals($data["created"], $member->created);
        $this->assertEquals($data["modified"], $member->modified);
    }
}


?>
