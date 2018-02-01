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

    /**
     * HTTP response code
     *
     * @var int $code
     */
    public $code = 200;

    /**
     * Model error array
     *
     * @var array $error
     */
    public $errors = [];

    /**
     * Construct
     *
     * @param LoggerInterface $logger
     * @param Builder $table
     *
     * @return void
     */
    public function __construct(LoggerInterface $logger, Builder $table)
    {
        $this->logger = $logger;
        $this->Game = new GameRepository($table);
    }

    /**
     * Add new game
     *
     * @param array $data Game data
     *
     * @return array Game added
     */
    public function add(array $data)
    {
        $game = $this->Game->add($data);
        if (empty($game)) {
            $this->code = 400;
            $this->errors = $this->Game->getErrors();
        };
        return $game;
    }

    /**
     * Delete a game
     *
     * @param int $id Game id
     *
     * @return int True if deleted
     */
    public function delete(int $id)
    {
        $deleted = $this->Game->delete($id);
        if (!$deleted) {
            $this->code = 204;
        }
        return $deleted;
    }

    /**
     * Find a game
     *
     * @param int $id Game id
     *
     * @return array Game data
     */
    public function find(int $id) : array
    {
        $game = $this->Game->find($id);
        if (empty($game)) {
            $this->code = 204;
        }
        return $game;
    }

    /**
     * Get all games
     *
     * @return array Game collection
     */
    public function get()
    {
        return $this->Game->get();
    }

    /**
     * Update game data
     *
     * @param int $id Game unique id
     * @param array $data Game new data
     *
     * @return array Game data
     */
    public function update(int $id, array $data) : array
    {
        $game = $this->Game->update($id, $data);
        if (empty($game)) {
            $this->code = 400;
        }
        return $game;
    }
}
