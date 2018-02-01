<?php

namespace Alpadia\Models\Repositories;

use \Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * Hidden attributes on queries.
     * Don't show pivot attribute on queries
     *
     * @var array $hidden
     */
    protected $hidden = ["pivot"];
    protected $table = "videogames";

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    /**
     * The roles that belong to the user.
     */
    public function members()
    {
        return $this->belongsToMany(
            'Alpadia\Models\Repositories\Member',
            'members_videogames',
            'videogame_id',
            'member_id'
        );
    }
}

?>
