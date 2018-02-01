<?php

use Alpadia\Models\Repositories\MemberRepository as MemberRepository;
use Illuminate\Database\Query\Builder as Builder;
use Illuminate\Database\Capsule\Manager as Manager;
use PHPUnit\Framework\TestCase;

class MemberRepositoryTest extends TestCase
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
        $table = $capsule->table("members");
        $this->Member = new MemberRepository($table);
    }

    public function test_add()
    {
        // Good data
        $data = [
            "name" => "John",
            "surname" => "Doe",
            "email" => "john@gmail.com"
        ];

        // bad request
        $badData = $data;
        unset($badData["surname"]);
        $result = $this->Member->add($badData);
        $this->assertInternalType("array", $result);
        $this->assertEquals([], $result);
        $errors = [
            0 => "Field 'surname' doesn't have a default value"
        ];
        $this->assertEquals($errors, $this->Member->getErrors());

        // bad request
        $badData = $data;
        $badData["email"] = "juan@gmail.com";
        $result = $this->Member->add($badData);
        $this->assertInternalType("array", $result);
        $this->assertEquals([], $result);
        $errors = [
            0 => "Field 'surname' doesn't have a default value",
            1 => "Duplicate entry 'juan@gmail.com' for key 'email'"
        ];
        $this->assertEquals($errors, $this->Member->getErrors());

        // sucess
        $result = $this->Member->add($data);
        $this->assertInternalType("array", $data);
        $this->assertEquals(["name","surname","email","modified","created","id"], array_keys($result));
        $this->assertInternalType("int",$result["id"]);
        $this->assertInternalType("string",$result["name"]);
        $this->assertInternalType("string",$result["surname"]);
        $this->assertInternalType("string",$result["email"]);
        $this->assertInternalType("string",$result["created"]);
        $this->assertInternalType("string",$result["modified"]);
    }


    public function test_find()
    {
        // item doesn't exists
        $result = $this->Member->find(1000);
        $this->assertInternalType("array", $result);
        $this->assertEquals([], $result);

        // item exists
        $result = $this->Member->find(1);
        $this->assertInternalType("array", $result);
        $this->assertEquals(["id","name","surname","email","created","modified"], array_keys($result));
        $this->assertInternalType("int",$result["id"]);
        $this->assertEquals(1,$result["id"]);
        $this->assertInternalType("string",$result["name"]);
        $this->assertEquals("Juan",$result["name"]);
        $this->assertInternalType("string",$result["email"]);
        $this->assertEquals("juan@gmail.com",$result["email"]);
        $this->assertInternalType("string",$result["surname"]);
        $this->assertEquals("Cava Platas",$result["surname"]);
        $this->assertInternalType("string",$result["created"]);
        $this->assertInternalType("string",$result["modified"]);
    }

    public function test_get()
    {
        $result = $this->Member->get();
        $this->assertInternalType("array", $result);
        $this->assertEquals(3, count($result));
        $this->assertEquals(["id","name","surname","email","created","modified"], array_keys($result[0]));
        $this->assertInternalType("int",$result[0]["id"]);
        $this->assertEquals(1,$result[0]["id"]);
        $this->assertInternalType("string",$result[0]["name"]);
        $this->assertEquals("Juan",$result[0]["name"]);
        $this->assertInternalType("string",$result[0]["surname"]);
        $this->assertEquals("Cava Platas",$result[0]["surname"]);
        $this->assertInternalType("string",$result[0]["email"]);
        $this->assertEquals("juan@gmail.com",$result[0]["email"]);
        $this->assertInternalType("string",$result[0]["created"]);
        $this->assertInternalType("string",$result[0]["modified"]);
    }

    public function test_update()
    {
        $data = [
            "name" => "John"
        ];

        // Bad update
        $badData = $data;
        $badData["email"] = "javier@gmail.com";
        $result = $this->Member->update(1, $badData);
        $this->assertInternalType("array",$result);
        $this->assertEquals([], $result);

        // bad update
        $result = $this->Member->update(1000, $data);
        $this->assertInternalType("array",$result);
        $this->assertEquals([], $result);

        // success
        $result = $this->Member->update(1, $data);
        $this->assertEquals(1,$result["id"]);
        $this->assertInternalType("string",$result["name"]);
        $this->assertEquals("John",$result["name"]);
        $this->assertInternalType("string",$result["surname"]);
        $this->assertEquals("Cava Platas",$result["surname"]);
        $this->assertInternalType("string",$result["created"]);
        $this->assertInternalType("string",$result["modified"]);
    }

    public function test_delete()
    {
        // bad request
        $result = $this->Member->delete(1000);
        $this->assertInternalType("int", $result);
        $this->assertEquals(0, $result);

        $result = $this->Member->delete(1);
        $this->assertInternalType("int", $result);
        $this->assertEquals(1, $result);
    }
}


?>
