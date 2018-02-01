<?php

namespace Alpadia\Utils;

use \Throwable as Throwable;

class ErrorHandler
{
    /**
     * Get error message from Throwable exception
     *
     * @param Throwable $e
     *
     * @return array Get formatted message
     */
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
