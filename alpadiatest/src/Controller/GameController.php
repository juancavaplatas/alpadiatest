<?php

namespace Alpadia\Controllers;

use Alpadia\Models\Repositories\Game as Game;
use Alpadia\Models\Factories\VideogameFactory as GameFactory;
use Psr\Log\LoggerInterface;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GameController
{
    private $logger;
    protected $table;

    public $code = 200;

    public function __construct(LoggerInterface $logger, Builder $table)
    {
        $this->logger = $logger;
        $this->table = $table;
    }

    public function add(array $data)
    {
        $game = GameFactory::createFromArray($data);
        if ($game->save()) {
            return $game->toArray();
        };

        $this->code = 400;
        return [];
    }

    public function delete(int $id)
    {
        $game = Game::where(["id"=>$id])->first();
        if ( isset($game) ) {
            return $game->delete();
        }
        $this->code = 204;
        return 0;
    }

    /**
     * Returns game identified by id
     */
    public function find(int $id) : array
    {
        return Game::where(["id"=>$id])->first()->toArray();
    }

    public function get()
    {
        return Game::get()->toArray();
    }

    public function update(int $id, array $data) : array
    {
        $member = Game::where(["id" => $id])->update($data);
        return $this->find($id);
    }
}
