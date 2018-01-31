<?php

namespace Alpadia\Controllers;

use Alpadia\Models\Factories\MemberFactory as MemberFactory;
use Alpadia\Models\Repositories\MemberModel as MemberModel;

class MemberController
{
    public $Member;

    public function __construct($db)
    {
        $this->Member = new MemberModel($db);
    }

    public function add(array $data)
    {
        $member = MemberFactory::createFromArray($data);
        return $this->Member->insert($member);
    }

    public function delete(int $id)
    {
        return $this->Member->delete($id);
    }

    public function find(int $id)
    {
        return $this->Member->find($id);
    }

    public function get()
    {
        return $this->Member->get();
    }
}

?>
