<?php

namespace Alpadia\Models\Repositories;

use Illuminate\Database\Query\Builder as Builder;

class Repository
{
    protected $table;
    protected $queryErrors = [];

    public function __construct(Builder $table)
    {
        $this->table = $table;
    }

    public function getErrors() : array
    {
        return $this->queryErrors;
    }
}

?>
