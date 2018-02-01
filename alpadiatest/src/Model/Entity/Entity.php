<?php

namespace Alpadia\Models\Entities;

class Entity
{
    protected $error = false;

    public function isError() : int
    {
        return $this->error;
    }

    public function setError($error)
    {
        $this->error = $error;
    }
}

?>
