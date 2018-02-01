<?php

namespace Alpadia\Models\Repositories;

use Alpadia\Models\Entities\Member as Member;
use Alpadia\Models\Factories\MemberFactory as MemberFactory;
use Alpadia\Models\Repositories\RepositoryInterface as RepositoryInterface;
use Illuminate\Database\Query\Builder as Builder;

class MemberRepository implements RepositoryInterface
{
    protected $table;

    public function __construct(Builder $table)
    {
        $this->table = $table;
    }

    public function add(array $data) : array
    {
        $member = MemberFactory::createFromArray($data);
        if ($member->save()) {
            return $member->toArray();
        };
        return [];
    }

    public function delete(int $id) : int
    {
        $member = Member::where(["id"=>$id])->first();
        if ( isset($member) ) {
            return $member->delete();
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
