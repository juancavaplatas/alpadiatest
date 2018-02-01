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

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'modified';
}

?>
