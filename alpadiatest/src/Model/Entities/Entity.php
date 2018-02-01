<?php

namespace Alpadia\Models\Entities;

use \Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    /**
     * Hidden attributes on queries.
     * Don't show pivot attribute on queries
     *
     * @var array $hidden
     */
    protected $hidden = ["pivot"];

    
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
}

?>
