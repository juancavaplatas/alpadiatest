<?php

namespace Alpadia\Utils;

use \Throwable as Throwable;

class ErrorHandler
{
    public static function getErrorMessage(Throwable $e) : array
    {
        return [
            "message" => $e->getMessage(),
            "file" => $e->getFile(),
            "line" => $e->getLine()
        ];
    }
}

?>
