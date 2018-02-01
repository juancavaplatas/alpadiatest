<?php

namespace Alpadia\Models\Factories;

use \stdClass as stdClass;
use Alpadia\Models\Entities\Member as Member;

class MemberFactory
{
    public static function createFromArray(array $array)
    {
        // Create new member
        $member = new Member();

        // Fill new member
        foreach($array as $property => $value)
        {
            $member->$property = $value;
            unset($array->$property);
        }

        // Unset values
        unset($value);

        // Return new member
        return $member;
    }
}

?>
