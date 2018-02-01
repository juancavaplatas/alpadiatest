<?php

use Alpadia\Models\Factories\GameFactory as GameFactory;
use PHPUnit\Framework\TestCase;

class GameFactoryTest extends TestCase
{
    public function test_createFromArray()
    {
        $data = [
            "id" => 1,
            "name" => "Sonic the Hedgehog",
            "company" => "SEGA",
            "created" => "2017-01-01 00:00:00",
            "modified" => "2017-01-01 00:00:00"
        ];
        $game = GameFactory::createFromArray($data);
        $this->assertInternalType("object", $game);
        $this->assertInstanceOf("Alpadia\Models\Entities\Game", $game);
        $keys = array_keys($game->getAttributes());
        $this->assertEquals(["id","name","company","created","modified"], $keys);
        $this->assertEquals($data["id"], $game->id);
        $this->assertEquals($data["name"], $game->name);
        $this->assertEquals($data["company"], $game->company);
        $this->assertEquals($data["created"], $game->created);
        $this->assertEquals($data["modified"], $game->modified);
    }
}


?>
