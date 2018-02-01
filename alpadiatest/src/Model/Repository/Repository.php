<?php

namespace Alpadia\Models\Repositories;

use Illuminate\Database\Query\Builder as Builder;

class Repository
{
    protected $table;
    protected $queryErrors = [];

    /**
     * Construct
     *
     * @param Builder $table
     *
     * @return void
     */
    public function __construct(Builder $table)
    {
        $this->table = $table;
    }

    /**
     * Get queryErrors attribute
     *
     * @return array
     */
    public function getErrors() : array
    {
        return $this->queryErrors;
    }
}

?>
