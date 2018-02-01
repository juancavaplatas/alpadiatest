<?php

namespace Alpadia\Models\Repositories;

class Model
{
    protected $db;
    protected $table;

    public function __construct($db)
    {
        $this->db = $db->table($this->table);
    }

    public function delete(int $id)
    {
        return $this->db->delete($id);
    }
}

?>
