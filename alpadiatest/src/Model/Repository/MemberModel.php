<?php

namespace Alpadia\Models\Repositories;

use Alpadia\Models\Entities\Member as Member;
use Alpadia\Models\Factories\MemberFactory as MemberFactory;
use Illuminate\Database\Query\Builder;

class MemberModel
{
    protected $db;
    protected $table = 'members';

    public function __construct($db)
    {
        $this->db = $db->table($this->table);
    }

    public function delete(int $id)
    {
        return $this->db->delete($id);
    }

    public function find(int $id)
    {
        $member = $this->db->find($id);
        return MemberFactory::createFromMap($member);
    }

    public function get()
    {
        // get collection
        $collection = $this->db->get();

        // Map collection to member entity
        $members = $collection->map(function ($member) {
            return MemberFactory::createFromMap($member);
        });

        // return members
        return $members;
    }

    public function insert(Member $data) : Member
    {
        $id = $this->db->insertGetId( get_object_vars($data) );
        $data->id = $id;
        return $data;
    }

    public function update(Member $data) : Member
    {
        $id = $data->id;
        unset($data->id);
        $return = $this->db->updateOrInsert( ["id" => $id], get_object_vars($data) );

        

        exit;
        return $data;
    }
}

?>
