<?php

namespace Alpadia\Controllers;

use Alpadia\Models\Factories\VideogameFactory as VideogameFactory;
use Alpadia\Models\Repositories\VideogameModel as VideogameModel;

class VideogameController
{
    public $Videogame;

    public function __construct($db)
    {
        $this->Videogame = new VideogameModel($db);
    }

    public function add(array $data)
    {
        $videogame = VideogameFactory::createFromArray($data);
        return $this->Videogame->insert($videogame);
    }

    public function find(int $id)
    {
        return $this->Videogame->find($id);
    }

    public function get()
    {
        return $this->Videogame->get();
    }
}

?>