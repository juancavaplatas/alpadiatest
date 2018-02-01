<?php

namespace Alpadia\Models\Entities;

use Alpadia\Models\Entities\Entity as Entity;

class Member extends Entity
{
    /**
     * Table name
     *
     * @var string $table
     */
    protected $table = "members";

    /**
     * The games that belong to the member
     */
    public function games()
    {
        return $this->belongsToMany(
            'Alpadia\Models\Entities\Game',
            'members_videogames',
            'member_id',
            'videogame_id'
        );
    }
}

?>
