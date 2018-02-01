<?php

namespace Alpadia\Models\Repositories;

use \Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * Hidden attributes on queries.
     * Don't show pivot attribute on queries
     *
     * @var array $hidden
     */
    protected $hidden = ["pivot"];
    protected $table = "members";


    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    /**
     * The games that belong to the member
     */
    public function games()
    {
        return $this->belongsToMany(
            'Alpadia\Models\Repositories\Game',
            'members_videogames',
            'member_id',
            'videogame_id'
        );
    }
}

?>
