<?php

namespace Alpadia\Utils;

use \Throwable as Throwable;

class ErrorHandler
{
    public static function getErrorMessage(Throwable $e) : array
    {
        $error = [
            "message" => $e->getMessage(),
            "file" => $e->getFile(),
            "line" => $e->getLine()
        ];
        return $error;
    }
}

?>
