<?php

namespace Alpadia\Controllers;

use Alpadia\Models\Repositories\GameRepository as GameRepository;
use Illuminate\Database\Query\Builder as Builder;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GameController
{
    private $logger;
    public $code = 200;

    public function __construct(LoggerInterface $logger, Builder $table)
    {
        $this->logger = $logger;
        $this->Game = new GameRepository($table);
    }

    public function add(array $data)
    {
        $game = $this->Game->add($data);
        if (empty($game)) {
            $this->code = 400;
        };
        return $game;
    }

    public function delete(int $id)
    {
        $deleted = $this->Game->delete($id);
        if (!$deleted) {
            $this->code = 204;
        }
        return $deleted;
    }

    /**
     * Returns game identified by id
     */
    public function find(int $id) : array
    {
        $game = $this->Game->find($id);
        if (empty($game)) {
            $this->code = 204;
        }
        return $game;
    }

    public function get()
    {
        return $this->Game->get();
    }

    public function update(int $id, array $data) : array
    {
        $game = $this->Game->update($id, $data);
        if (empty($game)) {
            $this->code = 204;
        }
        return $game;
    }
}
