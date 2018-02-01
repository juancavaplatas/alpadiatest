<?php

namespace Alpadia\Models\Factories;

use Alpadia\Models\Entities\Game as Game;

class GameFactory
{
    public static function createFromArray(array $array)
    {
        // Create new videogame
        $videogame = new Game();

        // Fill new videogame
        foreach($array as $property => $value)
        {
            $videogame->$property = $value;
            unset($array->$property);
        }

        // Unset values
        unset($value);

        // Return new videogame
        return $videogame;
    }
}

?>
