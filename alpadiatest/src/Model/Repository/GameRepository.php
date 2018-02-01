<?php

namespace Alpadia\Models\Repositories;

use Alpadia\Models\Entities\Game as Game;
use Alpadia\Models\Factories\GameFactory as GameFactory;
use Alpadia\Models\Repositories\Repository as Repository;
use Alpadia\Models\Repositories\RepositoryInterface as RepositoryInterface;
use Illuminate\Database\QueryException as QueryException;

class GameRepository extends Repository implements RepositoryInterface
{
    public function add(array $data) : array
    {
        $game = GameFactory::createFromArray($data);

        try {
            if ($game->save()) {
                return $game->toArray();
            }

        } catch (QueryException $e) {
            $this->queryErrors[] = $e->errorInfo[2];
        }

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
        try {
            $updated = Game::where(["id" => $id])->update($data);
            if ($updated) {
                return $this->find($id);
            }
        } catch (QueryException $e) {

            $this->queryErrors[] = $e->errorInfo[2];
        }
        return [];
    }
}

?>
