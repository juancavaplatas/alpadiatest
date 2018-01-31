<?php

namespace Alpadia\Models\Repositories;

use Alpadia\Models\Entities\Videogame as Videogame;
use Alpadia\Models\Factories\VideogameFactory as VideogameFactory;
use Illuminate\Database\Query\Builder;

class VideogameModel
{
    protected $db;
    protected $table = 'videogames';

    public function __construct($db)
    {
        $this->db = $db->table($this->table);
    }

    public function delete(int $id)
    {
        return $this->db->delete($id);
    }

    public function find(int $id)
    {
        $videogame = $this->db->find($id);
        return VideogameFactory::createFromMap($videogame);
    }

    public function get()
    {
        // get collection
        $collection = $this->db->get();

        // Map collection to videogame entity
        $videogames = $collection->map(function ($videogame) {
            return VideogameFactory::createFromMap($videogame);
        });

        // return videogames
        return $videogames;
    }

    public function insert(Videogame $data) : Videogame
    {
        $id = $this->db->insertGetId( get_object_vars($data) );
        $data->id = $id;
        return $data;
    }

    public function update(Member $data) : Member
    {
        $id = $this->db->update( get_object_vars($data) );
        $data->id = $id;
        return $data;
    }
}

?>
