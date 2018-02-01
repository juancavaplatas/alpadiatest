<?php

use Alpadia\Models\Repositories\GameRepository as GameRepository;
use Illuminate\Database\Query\Builder as Builder;
use Illuminate\Database\Capsule\Manager as Manager;
use PHPUnit\Framework\TestCase;

class GameRepositoryTest extends TestCase
{
    public function __construct()
    {
        $db = [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'test_alpadia',
            'username'  => 'root',
            'password'  => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ];
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($db);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $table = $capsule->table("videogames");
        $this->Game = new GameRepository($table);
    }

    public function test_add()
    {
        // Good data
        $data = [
            "name" => "The Legend of Zelda"
        ];

        // bad request
        $badData = $data;
        unset($badData["name"]);
        $result = $this->Game->add($badData);
        $this->assertInternalType("array", $result);
        $this->assertEquals([], $result);
        $errors = [
            0 => "Field 'name' doesn't have a default value"
        ];
        $this->assertEquals($errors, $this->Game->getErrors());

        // sucess
        $result = $this->Game->add($data);
        $this->assertInternalType("array", $data);
        $this->assertEquals(["name","modified","created","id"], array_keys($result));
        $this->assertInternalType("int",$result["id"]);
        $this->assertInternalType("string",$result["name"]);
        $this->assertInternalType("string",$result["created"]);
        $this->assertInternalType("string",$result["modified"]);
    }

    public function test_find()
    {
        // item doesn't exists
        $result = $this->Game->find(1000);
        $this->assertInternalType("array", $result);
        $this->assertEquals([], $result);

        // item exists
        $result = $this->Game->find(1);
        $this->assertInternalType("array", $result);
        $this->assertEquals(["id","name","company","created","modified"], array_keys($result));
        $this->assertInternalType("int",$result["id"]);
        $this->assertEquals(1,$result["id"]);
        $this->assertInternalType("string",$result["name"]);
        $this->assertEquals("Megaman",$result["name"]);
        $this->assertEquals("SEGA",$result["company"]);
        $this->assertInternalType("string",$result["created"]);
        $this->assertInternalType("string",$result["modified"]);
    }

    public function test_get()
    {
        $result = $this->Game->get();
        $this->assertInternalType("array", $result);
        $this->assertEquals(5, count($result));
        $this->assertEquals(["id","name","company","created","modified"], array_keys($result[0]));
        $this->assertInternalType("int",$result[0]["id"]);
        $this->assertEquals(1,$result[0]["id"]);
        $this->assertInternalType("string",$result[0]["name"]);
        $this->assertEquals("Megaman",$result[0]["name"]);
        $this->assertEquals("SEGA",$result[0]["company"]);
        $this->assertInternalType("string",$result[0]["created"]);
        $this->assertInternalType("string",$result[0]["modified"]);
    }

    public function test_update()
    {
        $data = [
            "name" => "Parodius",
            "company" => "SEGA"
        ];

        // game does not exists
        $result = $this->Game->update(1000, $data);
        $this->assertInternalType("array",$result);
        $this->assertEquals([], $result);

        // bad company name
        $badData = $data;
        $badData["company"] = "Rare";
        $result = $this->Game->update(1, $badData);
        $this->assertEquals([], $result);
        $errors = [
            0 => "Data truncated for column 'company' at row 1"
        ];
        $this->assertEquals($errors, $this->Game->getErrors());

        // success
        $result = $this->Game->update(1, $data);
        $this->assertEquals(["id","name","company","created","modified"], array_keys($result));
        $this->assertEquals(1,$result["id"]);
        $this->assertInternalType("string",$result["name"]);
        $this->assertEquals("Parodius",$result["name"]);
        $this->assertEquals("SEGA",$result["company"]);
        $this->assertInternalType("string",$result["created"]);
        $this->assertInternalType("string",$result["modified"]);
    }

    public function test_delete()
    {
        // bad request
        $result = $this->Game->delete(1000);
        $this->assertInternalType("int", $result);
        $this->assertEquals(0, $result);

        $result = $this->Game->delete(1);
        $this->assertInternalType("int", $result);
        $this->assertEquals(1, $result);
    }
}


?>
