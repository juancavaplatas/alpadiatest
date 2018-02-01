<?php

namespace Alpadia\Models\Repositories;

use Alpadia\Models\Entities\Member as Member;
use Alpadia\Models\Entities\Game as Game;
use Alpadia\Models\Factories\MemberFactory as MemberFactory;
use Alpadia\Models\Repositories\Repository as Repository;
use Alpadia\Models\Repositories\RepositoryInterface as RepositoryInterface;
use Illuminate\Database\QueryException as QueryException;

class MemberRepository extends Repository implements RepositoryInterface
{
    public function add(array $data) : array
    {
        $member = MemberFactory::createFromArray($data);
        try {
            if ($member->save()) {
                return $member->toArray();
            }

        } catch (QueryException $e) {
            $this->queryErrors[] = $e->errorInfo[2];
        }

        return [];
    }

    public function addGames(int $id, array $game_ids) : int
    {
        $member = Member::where(["id"=>$id])->first();
        if ( isset($member) ) {
            foreach ($game_ids as $game_id) {
                $updated = $member->games()->attach((int)$game_id);
            }
            return 1;
        }
        return 0;
    }

    public function delete(int $id) : int
    {
        $member = Member::where(["id"=>$id])->first();
        if ( isset($member) ) {
            return $member->delete();
        }
        return 0;
    }

    public function deleteGame(int $id, int $game_id) : int
    {
        $member = Member::where(["id"=>$id])->first();
        if ( isset($member) ) {
            return $member->games()->detach($game_id);
        }
        return 0;
    }

    public function find(int $id) : array
    {
        $member = Member::where(["id"=>$id])->first();
        if (isset($member)) {
            return $member->toArray();
        }
        return [];
    }

    public function games(int $id) : array
    {
        $collection = Member::where(["id"=>$id])->first()->games()->get();
        return $collection->toArray();
    }

    public function get() : array
    {
        return Member::get()->toArray();
    }

    public function update(int $id, array $data) : array
    {
        $updated = Member::where(["id" => $id])->update($data);
        if ($updated) {
            return $this->find($id);
        }
        return [];
    }
}

?>
