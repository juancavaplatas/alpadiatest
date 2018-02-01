<?php

namespace Alpadia\Models\Factories;

use \stdClass as stdClass;
use Alpadia\Models\Repositories\Game as Game;

class VideogameFactory
{
    /*public static function createFromMap(stdClass $object)
    {
        // Create new videogame
        $videogame = new Game();

        // Fill new videogame
        foreach($object as $property => &$value)
        {
            $videogame->$property = &$value;
            unset($object->$property);
        }

        // Unset values
        unset($value);
        $object = (unset) $object;

        // Return new videogame
        return $videogame;
    }*/

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

    /*public static function createErrorEntity()
    {
        // Create new videogame
        $videogame = new Videogame();
        $videogame->setError(true);
        return $videogame;
    }*/
}

?>
