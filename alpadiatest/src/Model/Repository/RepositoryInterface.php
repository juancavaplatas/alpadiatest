<?php

namespace Alpadia\Models\Repositories;

interface RepositoryInterface
{
    public function add(array $data) : array;
    public function delete(int $id) : int;
    public function find(int $id) : array;
    public function get() : array;
    public function update(int $id, array $data) : array;
}

?>
