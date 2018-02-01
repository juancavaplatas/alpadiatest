<?php

namespace Alpadia\Models\Factories;

use Alpadia\Models\Entities\Game as Game;

class GameFactory
{
    /**
     * Create new entity from array
     * Create an empty entity and then fill it with the array data
     * @param array $array Data
     * @return Game Game entity
     */
    public static function createFromArray(array $array) : Game
    {
        $videogame = new Game();
        foreach($array as $property => $value)
        {
            $videogame->$property = $value;
            unset($array->$property);
        }
        unset($value);
        return $videogame;
    }
}

?>
