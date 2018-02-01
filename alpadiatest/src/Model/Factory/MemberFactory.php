<?php

namespace Alpadia\Models\Factories;

use Alpadia\Models\Entities\Member as Member;

class MemberFactory
{
    /**
     * Create new entity from array
     * Create an empty entity and then fill it with the array data
     * @param array $array Data
     * @return Member Member entity
     */
    public static function createFromArray(array $array) : Member
    {
        $member = new Member();
        foreach($array as $property => $value)
        {
            $member->$property = $value;
            unset($array->$property);
        }
        unset($value);
        return $member;
    }
}

?>
