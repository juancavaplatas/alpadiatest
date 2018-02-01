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
    /**
     * Add new member
     *
     * @param array $data Member data
     *
     * @return array Member added
     */
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

    /**
     * Add game to member collection
     *
     * @param int $id Member id
     * @param int $game_id Game id
     *
     * @return int 1 if added
     */
    public function addGame(int $id, int $game_id) : int
    {
        $member = Member::where(["id"=>$id])->first();
        if ( isset($member) ) {
            $member->games()->attach($game_id);
            return 1;
        }
        return 0;
    }

    /**
     * Delete a member
     *
     * @param int $id Member id
     *
     * @return int True if delete
     */
    public function delete(int $id) : int
    {
        $member = Member::where(["id"=>$id])->first();
        if ( isset($member) ) {
            return $member->delete();
        }
        return 0;
    }

    /**
     * Delete a game from member collection
     *
     * @param int $id Member id
     * @param int $game_id Game id
     *
     * @return int True if deleted
     */
    public function deleteGame(int $id, int $game_id) : int
    {
        $member = Member::where(["id"=>$id])->first();
        if ( isset($member) ) {
            return $member->games()->detach($game_id);
        }
        return 0;
    }

    /**
     * Find a member
     *
     * @param int $id Member id
     *
     * @return array Member data
     */
    public function find(int $id) : array
    {
        $member = Member::where(["id"=>$id])->first();
        if (isset($member)) {
            return $member->toArray();
        }
        return [];
    }

    /**
     * Retrieve member games
     *
     * @param int $id Unique member id
     *
     * @return array
     */
    public function games(int $id) : array
    {
        $collection = Member::where(["id"=>$id])->first()->games()->get();
        return $collection->toArray();
    }

    /**
     * Get all members
     *
     * @return array Member collection
     */
    public function get() : array
    {
        return Member::get()->toArray();
    }

    /**
     * Update member data
     *
     * @param int $id Member unique id
     * @param array $data Member new data
     *
     * @return array Member data
     */
    public function update(int $id, array $data) : array
    {
        try {
            $updated = Member::where(["id" => $id])->update($data);
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
