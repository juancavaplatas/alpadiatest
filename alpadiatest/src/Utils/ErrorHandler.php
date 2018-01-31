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
        print_r($error);
        exit;
        return $error;
    }
}

?>
