<?php

namespace Alpadia\Models\Entities;

use Alpadia\Models\Entities\Entity as Entity;

class Game extends Entity
{
    /**
     * Table name
     *
     * @var string $table
     */
    protected $table = "videogames";

    /**
     * The roles that belong to the user.
     */
    public function members()
    {
        return $this->belongsToMany(
            'Alpadia\Models\Entities\Member',
            'members_videogames',
            'videogame_id',
            'member_id'
        );
    }
}

?>
