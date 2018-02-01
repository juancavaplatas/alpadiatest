<?php

namespace Alpadia\Models\Repositories;

use Alpadia\Models\Entities\Game as Game;
use Alpadia\Models\Factories\GameFactory as GameFactory;
use Alpadia\Models\Repositories\RepositoryInterface as RepositoryInterface;
use Illuminate\Database\Query\Builder as Builder;

class GameRepository implements RepositoryInterface
{
    protected $table;

    public function __construct(Builder $table)
    {
        $this->table = $table;
    }

    public function add(array $data) : array
    {
        $game = GameFactory::createFromArray($data);
        if ($game->save()) {
            return $game->toArray();
        };
        return [];
    }

    public function delete(int $id) : int
    {
        $game = Game::where(["id"=>$id])->first();
        if ( isset($game) ) {
            return $game->delete();
        }
        return 0;
    }

    public function find(int $id) : array
    {
        $game = Game::where(["id"=>$id])->first();
        if (isset($game)) {
            return $game->toArray();
        }
        return [];
    }

    public function get() : array
    {
        return Game::get()->toArray();
    }

    public function update(int $id, array $data) : array
    {
        $updated = Game::where(["id" => $id])->update($data);
        if ($updated) {
            return $this->find($id);
        }
        return [];
    }
}

?>
